<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ServiceEnquiry;
use App\Models\DownloadPage;
use App\Models\DownloadSection;
use App\Models\DownloadManual;
use Illuminate\Support\Facades\DB;
use App\Mail\ServiceRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Helper\SeoHelper;
use Illuminate\Support\Facades\Route;

class WebsiteController extends Controller
{
    public function homePage()
    {
        $categories = Category::with('categoryDescription')->where('type', 'product')->where('parent_id', NULL)->get();
        $seo = SeoHelper::get('home');
        // return $categories;
        return view('website.home', compact('categories', 'seo'));
    }

    public function aboutPage()
    {
        $seo = SeoHelper::get('about');
        return view('website.about', compact('seo'));
    }

    public function blogPage()
    {
        $query = Blog::query()
            ->select([
                'id',
                'title',
                'slug',
                'content',
                'featured_image',
                'status',
                'author_id',
                'created_at'
            ])
            ->with(['categories:id,name,slug'])   // only required columns
            ->where('status', 'Published');        // avoid drafts in listing

        $perPage = 12;

        $blogs = $query
            ->orderByDesc('created_at')            // explicit, index-friendly
            ->paginate($perPage);

        // return $blogs;
        return view('website.blogs', compact('blogs'));
    }

    public function blogDetailPage($slug)
    {
        $blog = Blog::with(['author', 'categories'])
            ->where('slug', $slug)
            ->firstOrFail();
        $seo = SeoHelper::get('blog', $blog->id);
        return view('website.blog-detail', compact('blog', 'seo'));
    }

    public function servicePage()
    {
        $seo = SeoHelper::get('service');
        return view('website.service', compact('seo'));
    }

    public function contactPage()
    {
        $seo = SeoHelper::get('contact');
        return view('website.contact', compact('seo'));
    }

    public function downloadPage()
    {
        $downloads = DownloadPage::with(['downloadDocument.documentDownload'])->get();
        $downloads = DownloadPage::select(
            'download_pages.*',

            'ds.id as section_id',
            'ds.title as section_title',

            'd.id as document_id',
            'd.title as document_title',
            'd.slug as document_slug',
            'd.file_path',
            'd.file_type',

            'dsd.sort_order as document_sort_order'
        )
            ->leftjoin(
                'download_section_document as dsd',
                'dsd.page_id',
                '=',
                'download_pages.id'
            )
            ->leftJoin(
                'download_sections as ds',
                'ds.id',
                '=',
                'dsd.section_id'
            )
            ->leftjoin(
                'documents as d',
                'd.id',
                '=',
                'dsd.document_id'
            )
            ->orderBy('download_pages.sort_order')
            ->orderBy('ds.sort_order')
            ->orderBy('dsd.sort_order')
            ->get();
        // return response()->json([
        //     'data' => $downloads
        // ]);
        $routeName = Route::currentRouteName();

        $pageType = match ($routeName) {
            'download' => 'download',
            'resource' => 'resource',
            default => null,
        };

        $seo = $pageType ? SeoHelper::get($pageType) : null;
        return view('website.download', compact('downloads', 'seo'));
    }

    public function downloadSubPage($slug)
    {
        $downloadData = DownloadPage::with(['sections'])->where('download_pages.slug', $slug)->first();
        return view('website.sub-download', compact('downloadData'));
    }

    public function mainDownloadPage($slug1, $slug2)
    {
        // $data = DB::select(
        //     'SELECT * FROM download_section_document WHERE section_id = ?',
        //     [$slug2]
        // );
        $section = DownloadSection::with('documents')
            ->where('id', $slug2)
            ->first();
        // return response()->json([
        //     'data' => $data,
        //     'section' => $section,
        // ]);
        return view('website.maindownload', compact('section'));
    }

    public function portableOnsiteMachiningTools()
    {
        return view('website.portable-onsite-machining-tools');
    }

    public function clamshellSplitFramesCuttersandAccessories()
    {
        return view('website.clamshell-split-frames-cutters-accessories');
    }

    public function pipeCuttingBevelingMachine()
    {
        return view('website.pipe-cutting-beveling-machine');
    }

    public function productDetail($id)
    {
        $product = Product::with([
            'categories' => function ($q) {
                $q->select(
                    'categories.id',
                    'categories.name',
                    'categories.slug',
                    'categories.parent_id'
                )->with('parent:id,name,slug,parent_id');
            },

            'galleryImages:id,product_id,image_path',

            'documents' => function ($q) {
                $q->wherePivot('show_on_product', 1)
                    ->select('documents.id', 'title', 'file_path');
            },

            'relatedProducts:id,name,featured_image',

            'accessories:id,name,image,document'
        ])->findOrFail($id);


        /* =========================
        Dynamic Table Decode
        ========================== */
        $product->dynamic_table = $product->dynamic_table
            ? json_decode($product->dynamic_table, true)
            : null;


        /* =========================
        MERGE FEATURE + GALLERY
        ========================== */

        $images = [];

        if ($product->featured_image) {
            $images[] = [
                'type' => 'featured',
                'image_path' => $product->featured_image,
                'image_url' => $product->featured_image_url
            ];
        }

        foreach ($product->galleryImages as $img) {
            $images[] = [
                'type' => 'gallery',
                'image_path' => $img->image_path,
                'image_url' => $img->image_url
            ];
        }

        $product->images = $images;


        /* =========================
        RELATED + ACCESSORY LOGIC
        ========================== */

        $relatedItems = [];

        // Special product condition
        // $isSpecialProduct = $product->sku === '003'; // Change if needed
        $isSpecialProduct =
            $product->name === 'Narrow Profile Hydraulic Torque Wrench' ||
            $product->name === 'Low Profile Hydraulic Torque Wrench';


        /* -------------------------
        1️⃣ Related Products
        --------------------------*/
        foreach ($product->relatedProducts as $rel) {
            $relatedItems[] = [
                'type' => 'product',
                'id' => $rel->id,
                'name' => $rel->name,
                'image' => $rel->featured_image,
                'image_url' => $rel->featured_image
                    ? asset($rel->featured_image)
                    : null,
            ];
        }


        /* -------------------------
        2️⃣ Accessories Handling
        --------------------------*/

        if ($isSpecialProduct) {

            // Accessories separate section ke liye
            $product->comparison_accessories = $product->accessories;
        } else {

            // Normal products → merge into related slider
            foreach ($product->accessories as $acc) {
                $relatedItems[] = [
                    'type' => 'accessory',
                    'id' => $acc->id,
                    'name' => $acc->name,
                    'image' => $acc->image,
                    'image_url' => $acc->image
                        ? asset($acc->image)
                        : null,
                    'document' => $acc->document,
                    'document_url' => $acc->document
                        ? asset($acc->document)
                        : null,
                ];
            }
        }

        $product->related_items = $relatedItems;
        $product->dimensionalDiagram = $product->dimensionalDiagram
            ? asset($product->dimensionalDiagram)
            : null;
        return $product;
        return view('website.product-details', compact('product'));
    }

    public function productDetailBySlug($slug)
    {
        $product = Product::with([
            'categories' => function ($q) {
                $q->select(
                    'categories.id',
                    'categories.name',
                    'categories.slug',
                    'categories.parent_id'
                )->with('parent:id,name,slug,parent_id');
            },

            'galleryImages:id,product_id,image_path',

            'documents' => function ($q) {
                $q->wherePivot('show_on_product', 1)
                    ->select('documents.id', 'title', 'file_path');
            },

            'relatedProducts:id,name,featured_image,slug',

            'accessories:id,name,image,document'
        ])->where('slug', $slug)->firstOrFail();


        /* =========================
        Dynamic Table Decode
        ========================== */
        $product->dynamic_table = $product->dynamic_table
            ? json_decode($product->dynamic_table, true)
            : null;


        /* =========================
        MERGE FEATURE + GALLERY
        ========================== */

        $images = [];

        if ($product->featured_image) {
            $images[] = [
                'type' => 'featured',
                'image_path' => $product->featured_image,
                'image_url' => $product->featured_image_url
            ];
        }

        foreach ($product->galleryImages as $img) {
            $images[] = [
                'type' => 'gallery',
                'image_path' => $img->image_path,
                'image_url' => $img->image_url
            ];
        }

        $product->images = $images;


        /* =========================
        RELATED + ACCESSORY LOGIC
        ========================== */

        $relatedItems = [];

        // Special product condition
        // $isSpecialProduct = $product->sku === '003'; // Change if needed
        $isSpecialProduct =
            $product->name === 'Narrow Profile Hydraulic Torque Wrench' ||
            $product->name === 'Low Profile Hydraulic Torque Wrench' || $product->sku == 'NH SERIES' || $product->sku == 'TH SERIES';


        /* -------------------------
        1️⃣ Related Products
        --------------------------*/
        foreach ($product->relatedProducts as $rel) {
            $relatedItems[] = [
                'type' => 'product',
                'id' => $rel->id,
                'name' => $rel->name,
                'slug' => $rel->slug,
                'image' => $rel->featured_image,
                'image_url' => $rel->featured_image
                    ? asset($rel->featured_image)
                    : null,
            ];
        }


        /* -------------------------
        2️⃣ Accessories Handling
        --------------------------*/

        if ($isSpecialProduct) {

            // Accessories separate section ke liye
            $product->comparison_accessories = $product->accessories;
        } else {

            // Normal products → merge into related slider
            foreach ($product->accessories as $acc) {
                $relatedItems[] = [
                    'type' => 'accessory',
                    'id' => $acc->id,
                    'name' => $acc->name,
                    'image' => $acc->image,
                    'image_url' => $acc->image
                        ? asset($acc->image)
                        : null,
                    'document' => $acc->document,
                    'document_url' => $acc->document
                        ? asset($acc->document)
                        : null,
                ];
            }
        }

        $product->related_items = $relatedItems;
        $product->dimensionalDiagram = $product->dimensionalDiagram
            ? asset($product->dimensionalDiagram)
            : null;
        // return $product;
        $seo = SeoHelper::get('product', $product->id);
        // return $seo;
        return view('website.product-details', compact('product', 'seo'));
    }

    public function mainProducts()
    {
        $categories = Category::with('categoryDescription')->where('type', 'product')->where('parent_id', NULL)->get();
        // return $categories;
        return view('website.main-product', compact('categories'));
    }

    public function subCategory($slug)
    {
        // $parentCategory = Category::where('slug', $slug)
        //     ->whereNull('parent_id')
        //     ->with(['children' => function ($query) {
        //         $query->with('products');
        //     }])
        //     ->firstOrFail();
        $parentCategory = Category::where('slug', $slug)
            ->whereNull('parent_id')
            ->with([
                'categoryDescription', // Parent category ki description aur images ke liye
                'children' => function ($query) {
                    $query->with([
                        'categoryDescription', // Sub-category ki description aur images ke liye
                        'products' => function ($productQuery) {
                            $productQuery->select(
                                'products.id',
                                'products.name',
                                'products.slug',
                                'products.featured_image'
                            );
                        }
                    ]);
                }
            ])
            ->firstOrFail();

        $subCategories = $parentCategory->children;
        // return response()->json([
        //     'parant' => $parentCategory,
        //     'child' => $subCategories
        // ]);
        return view('website.sub-category', compact('parentCategory', 'subCategories'));
    }

    public function sub_category($slug)
    {
        $category = Category::where('slug', $slug)
            ->with([
                'parent',
                'categoryDescription',
                'products' => function ($query) {
                    $query->where('status', 'Active')
                        ->orderBy('products.id', 'asc'); // id ke according ascending order
                }
            ])
            ->firstOrFail();
        // return response()->json(['data' => $category]);

        return view('website.child-category', compact('category'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name'         => 'required|string|max:255',
                'email'        => 'required|email|max:255',
                'phone'        => 'required|string|max:20',
                'service'      => 'required|string|max:255',
                'requirements' => 'nullable|string|min:5',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Create or fetch user
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name'  => $request->name,
                    'phone' => $request->phone,
                ]
            );

            // Store enquiry
            $serviceRequest = ServiceEnquiry::create([
                'user_id'      => $user->id,
                'service'      => $request->service,
                'requirements' => $request->requirements,
            ]);

            DB::commit();
            $service = ServiceEnquiry::with('user')->find($serviceRequest->id);
            // return $service;

            /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        | Mail failure should NOT rollback database.
        */

            try {

                Mail::to(config('mail.from.address'))
                    ->send(new ServiceRequestMail($service));
            } catch (\Exception $mailException) {

                Log::error('Service Request Mail Failed', [
                    'message' => $mailException->getMessage(),
                    'email'   => $request->email,
                ]);
            }

            return back()->with(
                'success',
                'Your enquiry has been submitted successfully.'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Service Enquiry Failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Something went wrong. Please try again later.'
                );
        }
    }

    public function downloadManual(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'contact' => 'required',
                'company' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            DownloadManual::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'contact' => $request->contact,
                    'company' => $request->company
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Manual downloaded successfully!',
                'file' => $request->file
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = \App\Models\Product::where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'slug', 'short_description', 'featured_image']);

        return response()->json($products);
    }

    public function privacyPolicyPage()
    {
        return view('website.privacy-policy');
    }

    public function termsConditionsPage()
    {
        return view('website.terms-conditions');
    }
}
