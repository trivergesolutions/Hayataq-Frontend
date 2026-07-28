<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Document;
use App\Models\SeoMeta;
use App\trait\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ApiResponseTrait;

    private function uploadFile($file, $folder)
    {
        // Original name without extension
        $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Sanitize: allow only letters, numbers, dash, underscore
        $sanitized = preg_replace('/[^A-Za-z0-9\-]/', '_', $original);

        // Remove multiple underscores
        $sanitized = preg_replace('/_+/', '_', $sanitized);

        // Optional: lowercase
        $sanitized = strtolower(trim($sanitized, '_'));

        $ext = $file->getClientOriginalExtension();

        $fileName = $sanitized . '_' . now()->format('YmdHis') . '.' . $ext;

        // Ensure folder exists
        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), 0777, true);
        }

        $file->move(public_path($folder), $fileName);

        return $folder . '/' . $fileName;
    }

    /* ================= LIST ================= */
    public function index(Request $request)
    {
        try {
            // ===============================
            // INPUTS (WITH DEFAULTS)
            // ===============================
            $page       = (int) $request->get('page', 1);
            $perPage    = (int) $request->get('per_page', 10);
            $search     = $request->get('search');
            $categoryId = $request->get('category_id');
            $status     = $request->get('status');

            $offset = ($page - 1) * $perPage;

            // ===============================
            // BASE QUERY
            // ===============================
            $query = Product::query()
                ->with('categories');

            // ===============================
            // SEARCH (NAME + SKU)
            // ===============================
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            }

            // ===============================
            // CATEGORY FILTER
            // ===============================
            if ($categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            }

            // ===============================
            // STATUS FILTER
            // ===============================
            if ($status) {
                $query->where('status', $status);
            }

            // ===============================
            // TOTAL COUNT (BEFORE LIMIT)
            // ===============================
            $total = $query->count();

            // ===============================
            // DATA WITH LIMIT + OFFSET
            // ===============================
            $products = $query
                ->orderBy('created_at', 'desc')
                ->offset($offset)
                ->limit($perPage)
                ->get();

            // ===============================
            // RESPONSE
            // ===============================
            return $this->success('Product list', [
                'data' => $products,
                'meta' => [
                    'total'        => $total,
                    'per_page'     => $perPage,
                    'current_page' => $page,
                    'last_page'    => ceil($total / $perPage),
                    'from'         => $total ? $offset + 1 : 0,
                    'to'           => min($offset + $perPage, $total),
                ]
            ]);
        } catch (Exception $e) {
            return $this->error('Failed to fetch products', 500, [$e->getMessage()]);
        }
    }


    /* ================= STORE ================= */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:products,slug',
                'sku' => 'required|unique:products,sku',
                'status' => 'required|in:Active,Draft',
                'category_ids' => 'required|array',

                'featured_image' => 'nullable|image',
                'gallery_images.*' => 'nullable|image',
                'dimensionalDiagram' => 'nullable|image',

                'documents.catalogue.*' => 'nullable|file',
                'documents.manual.*' => 'nullable|file',
                'documents.conversion_chart.*' => 'nullable|file',
                'documents.certificate.*' => 'nullable|file',

                'related_products' => 'nullable|array',
                'related_products.*' => 'nullable|exists:products,id',

                'accessories' => 'nullable|array',
                'accessories.*' => 'nullable|exists:accessories,id',

                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
            ]);

            /* ---------- FEATURE IMAGE ---------- */
            $featuredPath = null;
            if ($request->hasFile('featured_image')) {
                $featuredPath = $this->uploadFile(
                    $request->file('featured_image'),
                    'product/featureImage'
                );
            }

            $diagramPath = null;
            if ($request->hasFile('dimensionalDiagram')) {
                $diagramPath = $this->uploadFile(
                    $request->file('dimensionalDiagram'),
                    'product/diagram'
                );
            }

            /* ---------- CREATE PRODUCT ---------- */
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'sku' => $request->sku,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'status' => $request->status,
                'dynamic_table' => $request->dynamic_table,
                'featured_image' => $featuredPath,
                'dimensionalDiagram' => $diagramPath,
            ]);

            SeoMeta::create([
                'page_type'        => 'product',
                'reference_id'     => $product->id,
                'meta_title'       => $request->meta_title ?: $product->name,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
            ]);

            /* ---------- CATEGORIES ---------- */
            $product->categories()->sync($request->category_ids);

            /* ---------- GALLERY IMAGES ---------- */
            if ($request->hasFile('gallery_images')) {

                $galleryData = [];

                foreach ($request->file('gallery_images') as $img) {
                    $galleryData[] = [
                        'image_path' => $this->uploadFile($img, 'product/gallery')
                    ];
                }

                $product->galleryImages()->createMany($galleryData);
            }

            /* ---------- DOCUMENTS ---------- */
            if ($request->has('documents')) {
                foreach ($request->documents as $type => $files) {

                    if (!is_array($files)) {
                        $files = [$files];
                    }

                    foreach ($files as $file) {

                        $docPath = $this->uploadFile(
                            $file,
                            "documents/$type"
                        );

                        $document = Document::create([
                            'title' => ucfirst($type),
                            'slug' => uniqid(),
                            'file_path' => $docPath,
                            'file_type' => $file->getClientOriginalExtension(),
                            'document_type' => $type,
                            'created_by' => auth()->id(),
                        ]);

                        $product->documents()->attach($document->id, [
                            'show_on_product' => true
                        ]);
                    }
                }
            }

            /* ---------- RELATED PRODUCTS ---------- */
            $related = array_filter(
                $request->input('related_products', []),
                fn($id) => !empty($id) && $id != $product->id
            );
            $product->relatedProducts()->sync($related);

            /* ---------- ACCESSORIES ---------- */
            $accessories = array_filter($request->input('accessories', []));
            $syncData = [];
            foreach ($accessories as $index => $accessoryId) {
                $syncData[$accessoryId] = ['order' => $index + 1];
            }
            $product->accessories()->sync($syncData);

            DB::commit();

            return $this->success('Product created successfully', $product, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Product creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= SHOW BY ID ================= */
    public function show($id)
    {
        try {

            $product = Product::with([
                'categories:id,name,slug',

                'galleryImages:id,product_id,image_path',

                'documents' => function ($q) {
                    $q->wherePivot('show_on_product', true)
                        ->select('documents.id', 'title', 'file_path', 'document_type');
                },

                // RELATED PRODUCTS
                'relatedProducts:id,name,featured_image',

                // ACCESSORIES
                'accessories:id,name,image,document',
                'seoMeta'
            ])->findOrFail($id);
            $product->dimensionalDiagram = $product->diagram_image_url;
            $product->featured_image = $product->featured_image_url;
            return $this->success('Product details', $product);
        } catch (Exception $e) {
            return $this->error('Product not found', 404);
        }
    }

    public function showBySlug($slug)
    {
        try {

            $product = Product::with([
                'categories:id,name,slug',

                'galleryImages:id,product_id,image_path',

                'documents' => function ($q) {
                    $q->wherePivot('show_on_product', true)
                        ->select('documents.id', 'title', 'file_path', 'document_type');
                },

                // RELATED PRODUCTS
                'relatedProducts:id,name,featured_image',

                // ACCESSORIES
                'accessories:id,name,image,document',
                'seoMeta'
                // ])->findOrFail($id);
            ])->where('slug', $slug)->first();
            $product->dimensionalDiagram = $product->diagram_image_url;
            $product->featured_image = $product->featured_image_url;
            return $this->success('Product details', $product);
        } catch (Exception $e) {
            return $this->error('Product not found', 404);
        }
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::with(['galleryImages', 'documents'])->findOrFail($id);
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:products,slug,' . $product->id,
                'sku' => 'required|unique:products,sku,' . $product->id,
                'status' => 'required|in:Active,Draft',
                'category_ids' => 'required|array',

                'featured_image' => 'nullable|image',
                'gallery_images.*' => 'nullable|image',
                'dimensionalDiagram' => 'nullable|image',

                'documents.catalogue.*' => 'nullable|file',
                'documents.manual.*' => 'nullable|file',
                'documents.conversion_chart.*' => 'nullable|file',
                'documents.certificate.*' => 'nullable|file',

                // NEW VALIDATION
                'related_products' => 'nullable|array',
                'related_products.*' => 'nullable|exists:products,id',

                'accessories' => 'nullable|array',
                'accessories.*' => 'nullable|exists:accessories,id',

                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
            ]);

            /* =================================================
            FEATURED IMAGE
            ================================================= */
            if ($request->hasFile('featured_image')) {

                if ($product->featured_image && file_exists(public_path($product->featured_image))) {
                    unlink(public_path($product->featured_image));
                }

                $product->featured_image = $this->uploadFile(
                    $request->file('featured_image'),
                    'product/featureImage'
                );
            }

            if ($request->hasFile('dimensionalDiagram')) {

                if ($product->dimensionalDiagram && file_exists(public_path($product->dimensionalDiagram))) {
                    unlink(public_path($product->dimensionalDiagram));
                }

                $product->dimensionalDiagram = $this->uploadFile(
                    $request->file('dimensionalDiagram'),
                    'product/diagram'
                );
            }

            /* =================================================
            BASIC DATA
            ================================================= */
            $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'sku' => $request->sku,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'status' => $request->status,
                'dynamic_table' => $request->dynamic_table,
                'dimensionalDiagram' => $product->dimensionalDiagram,
            ]);

            /* =================================================
            CATEGORIES
            ================================================= */
            $product->categories()->sync($request->category_ids);

            /* =================================================
            GALLERY
            ================================================= */
            if ($request->hasFile('gallery_images')) {

                $galleryData = [];
            
                foreach ($request->file('gallery_images') as $img) {
            
                    $galleryData[] = [
                        'image_path' => $this->uploadFile($img, 'product/gallery'),
                    ];
                }
            
                $product->galleryImages()->createMany($galleryData);
            }

            /* =================================================
            DOCUMENTS
            ================================================= */
            if ($request->has('documents')) {

                foreach ($request->documents as $type => $files) {

                    if (!is_array($files)) {
                        $files = [$files];
                    }

                    $existingDocs = $product->documents()
                        ->where('document_type', $type)
                        ->get();

                    foreach ($existingDocs as $doc) {
                        if (file_exists(public_path($doc->file_path))) {
                            unlink(public_path($doc->file_path));
                        }

                        $product->documents()->detach($doc->id);
                        $doc->delete();
                    }

                    foreach ($files as $file) {

                        $docPath = $this->uploadFile($file, "documents/$type");

                        $document = Document::create([
                            'title' => ucfirst(str_replace('_', ' ', $type)),
                            'slug' => uniqid(),
                            'file_path' => $docPath,
                            'file_type' => $file->getClientOriginalExtension(),
                            'document_type' => $type,
                            'created_by' => auth()->id(),
                        ]);

                        $product->documents()->attach($document->id, [
                            'show_on_product' => true
                        ]);
                    }
                }
            }

            /* =================================================
            RELATED PRODUCTS
            ================================================= */
            $related = $request->input('related_products', []);
            $related = array_filter($related, fn($relId) => !empty($relId) && $relId != $product->id);
            $product->relatedProducts()->sync($related);

            /* =================================================
            ACCESSORIES
            ================================================= */
            $accessories = array_filter($request->input('accessories', []));
            $syncData = [];
            foreach ($accessories as $index => $accessoryId) {
                $syncData[$accessoryId] = ['order' => $index + 1];
            }
            $product->accessories()->sync($syncData);

            $product->seoMeta()->updateOrCreate(
                [
                    'page_type' => 'product'
                ],
                [
                    'meta_title' => $request->meta_title ?: $product->name,
                    'meta_description' => $request->meta_description,
                    'meta_keywords' => $request->meta_keywords,
                ]
            );

            DB::commit();

            return $this->success('Product updated successfully', $product);
        } catch (Exception $e) {

            DB::rollBack();

            return $this->error('Product update failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::with(['galleryImages', 'documents'])->findOrFail($id);

            /* =================================================
            FEATURED IMAGE
            ================================================= */
            if ($product->featured_image && file_exists(public_path($product->featured_image))) {
                unlink(public_path($product->featured_image));
            }


            if ($product->dimensionalDiagram && file_exists(public_path($product->dimensionalDiagram))) {
                unlink(public_path($product->dimensionalDiagram));
            }

            /* =================================================
            GALLERY IMAGES
            ================================================= */
            foreach ($product->galleryImages as $img) {
                if (file_exists(public_path($img->image_path))) {
                    unlink(public_path($img->image_path));
                }
            }
            $product->galleryImages()->delete();

            /* =================================================
            DOCUMENTS
            ================================================= */
            foreach ($product->documents as $doc) {

                // delete document file
                if ($doc->file_path && file_exists(public_path($doc->file_path))) {
                    unlink(public_path($doc->file_path));
                }

                // detach pivot
                $product->documents()->detach($doc->id);

                // delete document record
                $doc->delete();
            }

            /* =================================================
            SEO META
            ================================================= */
            $product->seoMeta()->delete();

            /* =================================================
            PRODUCT DELETE
            ================================================= */
            $product->delete();

            DB::commit();

            return $this->success('Product deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Delete failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= PRODUCTS BY CATEGORY ================= */
    public function byCategory($categoryId)
    {
        try {
            $products = Product::whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            })->with('categories')->get();

            return $this->success('Products by category', $products);
        } catch (Exception $e) {
            return $this->error('Failed to fetch products', 500, [$e->getMessage()]);
        }
    }

    public function updateSlug()
    {
        $products = Product::whereNull('slug')
            ->orWhere('slug', '')
            ->get();

        foreach ($products as $product) {

            $slug = Str::slug($product->name);

            // Unique slug generate karne ke liye
            $originalSlug = $slug;
            $count = 1;

            while (Product::where('slug', $slug)
                ->where('id', '!=', $product->id)
                ->exists()
            ) {

                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $product->update([
                'slug' => $slug
            ]);
        }

        return response()->json([
            'message' => 'slug updated!'
        ]);
    }
    
    public function deleteImage(Product $product, string $type)
    {
        if ($type == 'feature_image') {
            $column = 'featured_image';
        } elseif ($type == 'dimension_image') {
            $column = 'dimensionalDiagram';
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image type.',
            ], 422);
        }

        if (empty($product->$column)) {
            return response()->json([
                'success' => false,
                'message' => ucfirst(str_replace('_', ' ', $type)) . ' not found.',
            ], 404);
        }

        DB::beginTransaction();

        try {

            $filePath = public_path($product->$column);
            $path = NULL;
            if ($column ==  'featured_image') {
                $path = public_path('product/featureImage');
            } elseif ($column == 'dimensionalDiagram') {
                $path = public_path('product/diagram');
            }

            if (File::exists($path)) {
                File::delete($path);
            }

            $product->update([
                $column => null,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ucfirst(str_replace('_', ' ', $type)) . ' deleted successfully.',
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Image Delete Error', [
                'product_id' => $product->id,
                'type'       => $type,
                'error'      => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to delete image.',
            ], 500);
        }
    }
    
    public function deleteGalleryImage($id)
    {
        DB::beginTransaction();

        try {

            $image = ProductImage::find($id);

            if (!$image) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gallery image not found.'
                ], 404);
            }

            // Delete physical image
            if (!empty($image->image_path)) {

                $imagePath = public_path('product/gallery');

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Delete database record
            $image->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Gallery image deleted successfully.'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
