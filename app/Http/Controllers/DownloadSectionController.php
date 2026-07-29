<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownloadSection;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;


class DownloadSectionController extends Controller
{
    use ApiResponseTrait;

    /* ===================== LIST (BY PAGE) ===================== */
    public function index($pageId)
    {
        try {
            $sections = DownloadSection::where('page_id', $pageId)
                ->orderBy('sort_order')
                ->get();

            return $this->success('Download sections list', $sections);
        } catch (Exception $e) {
            return $this->error('Failed to fetch sections', 500);
        }
    }

    /* ===================== STORE ===================== */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'page_id' => 'required|exists:download_pages,id',
                'title'            => 'required|string|max:255',
                'sort_order'       => 'nullable|integer',
                'is_active'        => 'boolean',
            ]);
            // return $request->all();
            $section = DownloadSection::create($data);

            DB::commit();
            return $this->success('Download section created', $section, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Section creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ===================== SHOW ===================== */
    public function show($id)
    {
        try {
            $section = DownloadSection::findOrFail($id);
            return $this->success('Download section detail', $section);
        } catch (Exception $e) {
            return $this->error('Section not found', 404);
        }
    }

    /* ===================== UPDATE ===================== */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $section = DownloadSection::findOrFail($id);

            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'sort_order' => 'nullable|integer',
                'is_active'  => 'boolean',
            ]);

            $section->update($data);

            DB::commit();
            return $this->success('Download section updated', $section);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Section update failed', 500, [$e->getMessage()]);
        }
    }

    /* ===================== DELETE ===================== */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            DownloadSection::findOrFail($id)->delete();
            DB::commit();
            return $this->success('Download section deleted');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Section delete failed', 500, [$e->getMessage()]);
        }
    }
}
