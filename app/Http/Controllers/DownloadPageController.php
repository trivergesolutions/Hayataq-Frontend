<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DownloadPage;
use App\trait\ApiResponseTrait;
use Exception;

class DownloadPageController extends Controller
{
    use ApiResponseTrait;

    /* ===================== LIST ===================== */
    public function index()
    {
        try {
            $pages = DownloadPage::orderBy('sort_order')->get();
            return $this->success('Download pages list', $pages);
        } catch (Exception $e) {
            return $this->error('Failed to fetch pages', 500, [$e->getMessage()]);
        }
    }

    /* ===================== STORE ===================== */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'slug'       => 'required|string|unique:download_pages,slug',
                'status'     => 'required|in:Active,Draft',
                'sort_order' => 'nullable|integer',
            ]);

            $page = DownloadPage::create($data);

            DB::commit();
            return $this->success('Download page created', $page, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Page creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ===================== SHOW ===================== */
    public function show($slug)
    {
        try {
            // $page = DownloadPage::findOrFail($id);
            $page = DownloadPage::where('slug', $slug)->first();
            return $this->success('Download page detail', $page);
        } catch (Exception $e) {
            return $this->error('Page not found', 404);
        }
    }

    /* ===================== UPDATE ===================== */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $page = DownloadPage::findOrFail($id);

            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'slug'       => 'required|string|unique:download_pages,slug,' . $page->id,
                'status'     => 'required|in:Active,Draft',
                'sort_order' => 'nullable|integer',
            ]);

            $page->update($data);

            DB::commit();
            return $this->success('Download page updated', $page);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Page update failed', 500, [$e->getMessage()]);
        }
    }

    /* ===================== DELETE ===================== */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            DownloadPage::findOrFail($id)->delete();
            DB::commit();
            return $this->success('Download page deleted');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Page delete failed', 500, [$e->getMessage()]);
        }
    }
}
