<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\trait\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\SeoMeta;

class BlogController extends Controller
{
    use ApiResponseTrait;

    /* ================= INDEX ================= */

    public function index(Request $request)
    {
        try {
            $query = Blog::with(['author', 'categories']);

            /* ================= TITLE FILTER ================= */
            if ($request->filled('title')) {
                $query->where('title', 'LIKE', '%' . $request->title . '%');
            }

            /* ================= STATUS FILTER ================= */
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            /* ================= CATEGORY FILTER ================= */
            if ($request->filled('category_id')) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('categories.id', $request->category_id);
                });
            }

            /* ================= PAGINATION ================= */
            $perPage = $request->get('per_page', 10); // default 10

            $blogs = $query
                ->latest()
                ->paginate($perPage);

            return $this->success('Blogs list', $blogs);
        } catch (Exception $e) {
            return $this->error('Failed to fetch blogs', 500, [$e->getMessage()]);
        }
    }

    /* ================= STORE ================= */

    private function generateSlug($title)
    {
        // lowercase
        $slug = strtolower($title);

        // replace non-alphanumeric with _
        $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);

        // remove multiple _
        $slug = preg_replace('/_+/', '_', $slug);

        // trim _
        return trim($slug, '_');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'title'          => 'required|string|max:255',
                'content'        => 'required',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status'         => 'required|in:0,1',
                'category_ids'   => 'required|array|min:1',
                'category_ids.*' => 'exists:categories,id',
                // SEO
                'meta_title'          => 'nullable|string|max:255',
                'meta_description'    => 'nullable|string',
                'meta_keywords'       => 'nullable|string',
            ]);

            $slug = $this->generateSlug($request->title);

            // ensure uniqueness
            $originalSlug = $slug;
            $count = 1;

            while (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '_' . $count;
                $count++;
            }

            $imagePath = null;

            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $name  = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $file  = $name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('blog'), $file);
                $imagePath = 'blog/' . $file;
            }

            $blog = Blog::create([
                'title'          => $request->title,
                'slug'           => $slug,
                'content'        => $request->content,
                'featured_image' => $imagePath,
                'status'         => $request->status,
                'author_id'      => auth()->id(),
            ]);

            $blog->categories()->sync($request->category_ids);

            SeoMeta::create([
                'page_type'        => 'blog',
                'reference_id'     => $blog->id,
                'meta_title'       => $request->meta_title ?: $blog->title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
            ]);

            DB::commit();

            return $this->success('Blog created successfully', $blog->load('categories', 'seoMeta'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Blog creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= SHOW BY ID ================= */

    public function showById($id)
    {
        try {
            $blog = Blog::with(['author', 'categories', 'seoMeta'])->findOrFail($id);
            return $this->success('Blog details', $blog);
        } catch (Exception $e) {
            return $this->error('Blog not found', 404);
        }
    }

    /* ================= SHOW BY SLUG ================= */

    public function showBySlug($slug)
    {
        try {
            $blog = Blog::with(['author', 'categories', 'seoMeta'])
                ->where('slug', $slug)
                ->firstOrFail();

            return $this->success('Blog details', $blog);
        } catch (Exception $e) {
            return $this->error('Blog not found', 404);
        }
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $blog = Blog::findOrFail($id);

            $request->validate([
                'title'          => 'required|string|max:255',
                'content'        => 'required',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status'         => 'required|in:0,1',
                'category_ids'   => 'required|array|min:1',
                'category_ids.*' => 'exists:categories,id',
                // SEO
                'meta_title'          => 'nullable|string|max:255',
                'meta_description'    => 'nullable|string',
                'meta_keywords'       => 'nullable|string',
            ]);

            $slug = $this->generateSlug($request->title);

            // ensure uniqueness
            $originalSlug = $slug;
            $count = 1;

            // while (Blog::where('slug', $slug)->exists()) {
            //     $slug = $originalSlug . '_' . $count;
            //     $count++;
            // }

            while (
                Blog::where('slug', $slug)
                ->where('id', '!=', $blog->id)
                ->exists()
            ) {
                $slug = $originalSlug . '_' . $count;
                $count++;
            }

            if ($request->hasFile('featured_image')) {

                if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
                    unlink(public_path($blog->featured_image));
                }

                $image = $request->file('featured_image');
                $name  = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $file  = $name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('blog'), $file);
                $blog->featured_image = 'blog/' . $file;
            }

            $blog->update([
                'title'   => $request->title,
                'slug'    => $slug,
                'content' => $request->content,
                'status'  => $request->status,
            ]);

            $blog->categories()->sync($request->category_ids);

            $seo = SeoMeta::firstOrNew([
                'page_type'    => 'blog',
                'reference_id' => $blog->id,
            ]);

            $seo->fill([
                'meta_title'       => $request->meta_title ?: $blog->title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
            ]);

            $seo->save();

            DB::commit();

            return $this->success('Blog updated successfully', $blog->load('categories', 'seoMeta'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Blog update failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= DELETE ================= */

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $blog = Blog::findOrFail($id);

            // Delete SEO
            SeoMeta::where('page_type', 'blog')
                ->where('reference_id', $blog->id)
                ->delete();

            // Delete Image
            if (
                $blog->featured_image &&
                file_exists(public_path($blog->featured_image))
            ) {
                unlink(public_path($blog->featured_image));
            }

            // Remove Categories
            $blog->categories()->detach();

            // Delete Blog
            $blog->delete();

            DB::commit();

            return $this->success('Blog deleted successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            return $this->error(
                'Blog delete failed',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ================= BLOGS BY CATEGORY ================= */

    public function blogsByCategory($categoryId)
    {
        try {
            $category = Category::with('blogs.author')->findOrFail($categoryId);
            return $this->success('Category blogs', $category->blogs);
        } catch (Exception $e) {
            return $this->error('Category not found', 404);
        }
    }
}
