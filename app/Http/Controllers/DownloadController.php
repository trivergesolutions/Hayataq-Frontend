<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DownloadPage;
use App\Models\DownloadSection;
use App\Models\DownloadSectionDocument;
use App\Models\Document;
use App\Models\DownloadManual;
use App\trait\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DownloadController extends Controller
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

        // Lowercase + trim
        $sanitized = strtolower(trim($sanitized, '_'));

        $ext = $file->getClientOriginalExtension();

        $fileName = $sanitized . '_' . now()->format('YmdHis') . '.' . $ext;

        // Ensure folder exists
        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), 0777, true);
        }

        $file->move(public_path($folder), $fileName);

        return $folder . '/' . $fileName; // relative path
    }

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

            /* ================= PAGE ================= */

            $pageData = $request->input('page');

            $singlePage = $pageData['single_page'] ?? 0;

            $page = DownloadPage::create([
                'title'       => $pageData['title'],
                'slug'        => $pageData['slug'],
                'status'      => $pageData['status'] ?? 1,
                'sort_order'  => $pageData['sort_order'] ?? 0,
                'single_page' => $singlePage,
            ]);

            /* =========================================================
            | CASE 1:
            | single_page = 0
            | PAGE -> SECTION -> DOCUMENTS
            ========================================================= */

            if ($singlePage == 0 && !empty($request->sections)) {

                foreach ($request->sections as $sectionIndex => $sectionData) {

                    $section = DownloadSection::create([
                        'page_id'    => $page->id,
                        'title'      => $sectionData['title'],
                        'sort_order' => $sectionIndex + 1,
                    ]);

                    /* ================= DOCUMENTS ================= */

                    if (!empty($sectionData['documents'])) {

                        foreach ($sectionData['documents'] as $docIndex => $docData) {

                            if (
                                !$request->hasFile(
                                    "sections.$sectionIndex.documents.$docIndex.file"
                                )
                            ) {
                                continue;
                            }

                            $file = $request->file(
                                "sections.$sectionIndex.documents.$docIndex.file"
                            );

                            $filePath = $this->uploadFile(
                                $file,
                                'uploads/documents'
                            );

                            $document = Document::create([
                                'title'         => $docData['title'],
                                'slug'          => $docData['slug'],
                                'file_path'     => $filePath,
                                'file_type'     => $file->getClientOriginalExtension(),
                                'document_type' => 'download',
                                'status'        => $docData['status'] ?? 1,
                                'created_by'    => auth()->id(),
                            ]);

                            $section->documents()->attach($document->id);
                        }
                    }
                }
            }

            /* =========================================================
            | CASE 2:
            | single_page = 1
            | PAGE -> DOCUMENTS
            ========================================================= */
            if ($singlePage == 1 && !empty($request->sections)) {
                $defaultSection = DownloadSection::create([
                    'page_id'    => $page->id,
                    'title'      => $page->title,
                    'sort_order' => 1,
                ]);

                foreach ($request->sections as $sectionIndex => $sectionData) {

                    if (!empty($sectionData['documents'])) {

                        foreach ($sectionData['documents'] as $docIndex => $docData) {

                            if (
                                !$request->hasFile(
                                    "sections.$sectionIndex.documents.$docIndex.file"
                                )
                            ) {
                                continue;
                            }

                            $file = $request->file(
                                "sections.$sectionIndex.documents.$docIndex.file"
                            );

                            $filePath = $this->uploadFile(
                                $file,
                                'uploads/documents'
                            );

                            $document = Document::create([
                                'title'         => $docData['title'],
                                'slug'          => $docData['slug'],
                                'file_path'     => $filePath,
                                'file_type'     => $file->getClientOriginalExtension(),
                                'document_type' => 'download',
                                'status'        => $docData['status'] ?? 1,
                                'created_by'    => auth()->id(),
                            ]);

                            $defaultSection->documents()->attach($document->id, [
                                'page_id'    => $page->id,
                                'sort_order' => $docIndex + 1,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return $this->success(
                'Download page created successfully',
                $page->load('sections.documents')
            );
        } catch (Exception $e) {

            DB::rollBack();

            return $this->error(
                'Failed to store download data',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ===================== SHOW ===================== */
    public function show($slug)
    {
        try {
            $page = DownloadPage::where('slug', $slug)
                ->where('status', 1)
                ->with([
                    'sections' => function ($sectionQuery) {
                        $sectionQuery
                            // ->where('status', 1)
                            ->orderBy('sort_order')
                            ->with([
                                'documents' => function ($docQuery) {
                                    $docQuery
                                        ->where('status', 1)
                                        ->orderBy('id', 'DESC');
                                }
                            ]);
                    }
                ])
                ->first();

            if (!$page) {
                return $this->error('Download page not found', 404);
            }

            return $this->success(
                'Download page details',
                $page
            );
        } catch (Exception $e) {
            return $this->error(
                'Failed to fetch download page',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ===================== UPDATE ===================== */
    public function updateOld(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            /* ================= PAGE ================= */

            $page = DownloadPage::with('sections.documents')->findOrFail($id);

            $pageData = $request->input('page');

            $page->update([
                'title'      => $pageData['title'],
                'slug'       => $pageData['slug'],
                'status'     => $pageData['status'] ?? 1,
                'sort_order' => $pageData['sort_order'] ?? 0,
            ]);

            /* ================= SECTIONS ================= */

            foreach ($request->sections as $sectionIndex => $sectionData) {

                // create or update section
                $section = DownloadSection::firstOrCreate(
                    [
                        'page_id' => $page->id,
                        'title'   => $sectionData['title'],
                    ],
                    [
                        'sort_order' => $sectionIndex + 1,
                    ]
                );

                /* ================= DOCUMENTS (ADD ONLY) ================= */

                if (!empty($sectionData['documents'])) {

                    foreach ($sectionData['documents'] as $docIndex => $docData) {

                        if (!$request->hasFile(
                            "sections.$sectionIndex.documents.$docIndex.file"
                        )) {
                            continue;
                        }

                        $file = $request->file(
                            "sections.$sectionIndex.documents.$docIndex.file"
                        );

                        $filePath = $this->uploadFile(
                            $file,
                            'uploads/documents'
                        );

                        $document = Document::create([
                            'title'         => $docData['title'],
                            'slug'          => $docData['slug'],
                            'file_path'     => $filePath,
                            'file_type'     => $file->getClientOriginalExtension(),
                            'document_type' => 'download',
                            'status'        => $docData['status'] ?? 1,
                            'created_by'    => auth()->id(),
                        ]);

                        // attach without touching old docs
                        $section->documents()->attach($document->id);
                    }
                }
            }

            DB::commit();

            return $this->success(
                'Download page updated successfully',
                $page->fresh()->load('sections.documents')
            );
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error(
                'Failed to update download data',
                500,
                [$e->getMessage()]
            );
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            /* ================= PAGE ================= */

            $page = DownloadPage::with('sections.documents')
                ->findOrFail($id);

            $pageData = $request->input('page');

            $singlePage = $pageData['single_page'] ?? 0;

            $page->update([
                'title'       => $pageData['title'],
                'slug'        => $pageData['slug'],
                'status'      => $pageData['status'] ?? 1,
                'sort_order'  => $pageData['sort_order'] ?? 0,
                'single_page' => $singlePage,
            ]);

            /* =========================================================
        | CASE 1:
        | single_page = 0
        | PAGE -> SECTION -> DOCUMENTS
        ========================================================= */

            if ($singlePage == 0 && !empty($request->sections)) {

                foreach ($request->sections as $sectionIndex => $sectionData) {

                    /*
                | Create or update section
                */

                    $section = DownloadSection::updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'title'   => $sectionData['title'],
                        ],
                        [
                            'sort_order' => $sectionIndex + 1,
                        ]
                    );

                    /* ================= DOCUMENTS ================= */

                    if (!empty($sectionData['documents'])) {

                        foreach ($sectionData['documents'] as $docIndex => $docData) {

                            /*
                        | Skip old docs without new file
                        */

                            if (
                                !$request->hasFile(
                                    "sections.$sectionIndex.documents.$docIndex.file"
                                )
                            ) {
                                continue;
                            }

                            $file = $request->file(
                                "sections.$sectionIndex.documents.$docIndex.file"
                            );

                            $filePath = $this->uploadFile(
                                $file,
                                'uploads/documents'
                            );

                            $document = Document::create([
                                'title'         => $docData['title'],
                                'slug'          => $docData['slug'],
                                'file_path'     => $filePath,
                                'file_type'     => $file->getClientOriginalExtension(),
                                'document_type' => 'download',
                                'status'        => $docData['status'] ?? 1,
                                'created_by'    => auth()->id(),
                            ]);

                            $section->documents()->attach($document->id, [
                                'page_id'    => $page->id,
                                'sort_order' => $docIndex + 1,
                            ]);
                        }
                    }
                }
            }

            /* =========================================================
        | CASE 2:
        | single_page = 1
        | PAGE -> DOCUMENTS
        ========================================================= */

            if ($singlePage == 1 && !empty($request->sections)) {

                /*
            | Default hidden section
            */

                $defaultSection = DownloadSection::firstOrCreate(
                    [
                        'page_id' => $page->id,
                        'title'   => $page->title,
                    ],
                    [
                        'sort_order' => 1,
                    ]
                );

                foreach ($request->sections as $sectionIndex => $sectionData) {

                    if (!empty($sectionData['documents'])) {

                        foreach ($sectionData['documents'] as $docIndex => $docData) {

                            if (
                                !$request->hasFile(
                                    "sections.$sectionIndex.documents.$docIndex.file"
                                )
                            ) {
                                continue;
                            }

                            $file = $request->file(
                                "sections.$sectionIndex.documents.$docIndex.file"
                            );

                            $filePath = $this->uploadFile(
                                $file,
                                'uploads/documents'
                            );

                            $document = Document::create([
                                'title'         => $docData['title'],
                                'slug'          => $docData['slug'],
                                'file_path'     => $filePath,
                                'file_type'     => $file->getClientOriginalExtension(),
                                'document_type' => 'download',
                                'status'        => $docData['status'] ?? 1,
                                'created_by'    => auth()->id(),
                            ]);

                            $defaultSection->documents()->attach($document->id, [
                                'page_id'    => $page->id,
                                'sort_order' => $docIndex + 1,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return $this->success(
                'Download page updated successfully',
                $page->fresh()->load('sections.documents')
            );
        } catch (Exception $e) {

            DB::rollBack();

            return $this->error(
                'Failed to update download data',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ===================== DELETE ===================== */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $page = DownloadPage::with('sections.documents')->findOrFail($id);

            /* ================= DELETE FILES & DOCUMENTS ================= */

            foreach ($page->sections as $section) {

                foreach ($section->documents as $document) {

                    // 🔥 delete physical file
                    if (
                        $document->file_path &&
                        file_exists(public_path($document->file_path))
                    ) {
                        unlink(public_path($document->file_path));
                    }

                    // delete document record
                    $document->delete();
                }

                // delete section (pivot auto handled by cascade)
                $section->delete();
            }

            // finally delete page
            $page->delete();

            DB::commit();

            return $this->success(
                'Download page and all related data deleted successfully'
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error(
                'Failed to delete download page',
                500,
                [$e->getMessage()]
            );
        }
    }

    // Download Manual
    public function getManualDownloadList()
    {
        try {
            $data = DownloadManual::latest()->get();
            return $this->success('Download manual list', $data);
        } catch (Exception $e) {
            return $this->error('Failed to fetch manual', 500, [$e->getMessage()]);
        }
    }
}
