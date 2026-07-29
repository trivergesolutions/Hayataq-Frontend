<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /* ================= LIST ================= */
    public function index(Request $request)
    {
        try {
            $type = $request->get('type');
            $categories = Category::whereNull('parent_id')
                ->when($type, function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->with([
                    'categoryDescription', // Description load karne ke liye
                    'childrenRecursive.categoryDescription',
                ])
                ->get();

            return $this->success('Category hierarchy', $categories);
        } catch (Exception $e) {
            return $this->error(
                'Failed to fetch categories',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ================= GENERATE SLUG ================= */
    private function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);
        $slug = preg_replace('/_+/', '_', $slug);
        return trim($slug, '_');
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name'      => 'required|string|max:255',
                'type'      => 'required|in:product,blog',
                'parent_id' => 'nullable|exists:categories,id',
                'is_active' => 'nullable',
                'description'    => 'nullable|string',
                'category_images' => 'nullable|array',
                'category_images.*' => 'file|mimes:jpeg,png,jpg,webp,svg',
                'featured_index' => 'nullable|integer'
            ]);

            // generate slug from name
            $slug = $this->generateSlug($request->name);
            $originalSlug = $slug;
            $count = 1;

            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '_' . $count;
                $count++;
            }

            $category = Category::create([
                'name'      => $request->name,
                'slug'      => $slug,
                'type'      => $request->type,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);
            if ($request->type === 'product') {
                $imageDetails = [];

                if ($request->hasFile('category_images')) {
                    foreach ($request->file('category_images') as $index => $image) {
                        // Unique file name generate karein
                        $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                        // Public folder ke 'category' subfolder mein move karein
                        $image->move(public_path('category'), $fileName);

                        $imageDetails[] = [
                            'file_name'   => $fileName,
                            'full_path'   => 'category/' . $fileName,
                            'is_featured' => ($request->featured_index == $index) ? true : false
                        ];
                    }
                }

                $category->categoryDescription()->create([
                    'description' => $request->description,
                    'images'      => $imageDetails,
                ]);
            }

            DB::commit();

            return $this->success('Category created successfully', $category, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Category creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);

            $request->validate([
                'name'      => 'required|string|max:255',
                'parent_id' => 'nullable|exists:categories,id',
            ]);

            // regenerate slug ONLY if name changed
            if ($category->name !== $request->name) {
                $slug = $this->generateSlug($request->name);
                $originalSlug = $slug;
                $count = 1;

                while (
                    Category::where('slug', $slug)
                    ->where('id', '!=', $category->id)
                    ->exists()
                ) {
                    $slug = $originalSlug . '_' . $count;
                    $count++;
                }

                $category->slug = $slug;
            }

            $category->update([
                'name'      => $request->name,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);
            if ($category->type === 'product') {
                $description = $category->categoryDescription;
                $existingImages = $description ? $description->images : [];

                if ($request->hasFile('category_images')) {
                    // Agar nayi images aa rahi hain, toh purani files delete karni hai (Optional)
                    if (!empty($existingImages)) {
                        foreach ($existingImages as $oldImg) {
                            $oldPath = public_path('category/' . $oldImg['file_name']);
                            if (File::exists($oldPath)) File::delete($oldPath);
                        }
                    }

                    $newImageDetails = [];
                    foreach ($request->file('category_images') as $index => $image) {
                        $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('category'), $fileName);

                        $newImageDetails[] = [
                            'file_name'   => $fileName,
                            'full_path'   => asset('category/' . $fileName),
                            'is_featured' => ($request->featured_index == $index) ? true : false
                        ];
                    }
                    $existingImages = $newImageDetails;
                }

                $category->categoryDescription()->updateOrCreate(
                    ['categoryId' => $category->id],
                    [
                        'description' => $request->description,
                        'images'      => $existingImages
                    ]
                );
            }


            DB::commit();

            return $this->success('Category updated successfully', $category);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Category update failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::withCount([
                'children',
                'blogs',
                'products',
            ])->findOrFail($id);

            // ❌ child category exists
            if ($category->children_count > 0) {
                return $this->error(
                    'Category has child categories. Delete child categories first.',
                    409
                );
            }

            // ❌ linked with blogs
            if ($category->blogs_count > 0) {
                return $this->error(
                    'Category is associated with blogs. Remove category from blogs first.',
                    409
                );
            }

            // ❌ linked with products
            if ($category->products_count > 0) {
                return $this->error(
                    'Category is associated with products. Remove category from products first.',
                    409
                );
            }

            $category->delete();

            DB::commit();

            return $this->success('Category deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Category delete failed', 500, [$e->getMessage()]);
        }
    }
}
