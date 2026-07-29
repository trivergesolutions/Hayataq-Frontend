<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoMetaRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SeoMeta;
use App\trait\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SeoMetaController extends Controller
{

    use ApiResponseTrait;
    /**
     * SEO List
     */
    public function index()
    {
        try {

            $seoMeta = SeoMeta::latest()
                ->paginate(20);

            return $this->success(
                'SEO records fetched successfully.',
                $seoMeta
            );
        } catch (\Throwable $e) {

            Log::error('SEO List Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return $this->error(
                'Unable to fetch SEO records.',
                500
            );
        }
    }

    /**
     * Single SEO
     */
    public function show($id)
    {
        try {

            $seo = SeoMeta::findOrFail($id);

            return $this->success(
                'SEO record fetched successfully.',
                $seo
            );
        } catch (ModelNotFoundException $e) {

            return $this->error(
                'SEO record not found.',
                404
            );
        } catch (\Throwable $e) {

            Log::error('SEO Show Error', [
                'id' => $id,
                'message' => $e->getMessage()
            ]);

            return $this->error(
                'Something went wrong.',
                500
            );
        }
    }

    /**
     * Single SEO by page and refrence
     */
    public function getSeo(string $pageType, ?int $referenceId = null)
    {
        try {

            $seo = SeoMeta::where('page_type', $pageType)
                ->when(
                    $referenceId,
                    fn($q) =>
                    $q->where('reference_id', $referenceId)
                )
                ->first();

            return $this->success(
                'SEO record fetched successfully.',
                $seo
            );
        } catch (ModelNotFoundException $e) {
            return $this->error(
                'SEO record not found.',
                404
            );
        } catch (\Throwable $e) {
            return $this->error(
                'Something went wrong.',
                500
            );
        }
    }

    /**
     * Create SEO
     */
    public function store(SeoMetaRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            $exists = SeoMeta::where('page_type', $data['page_type'])
                ->where('reference_id', $data['reference_id'] ?? null)
                ->exists();

            if ($exists) {
                return $this->error(
                    'SEO already exists for this page.',
                    422
                );
            }

            $seo = SeoMeta::create($data);

            DB::commit();

            return $this->success(
                'SEO created successfully.',
                $seo,
                201
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('SEO Create Error', [
                'payload' => $request->all(),
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return $this->error(
                'Failed to create SEO record.',
                500
            );
        }
    }

    /**
     * Update SEO
     */
    public function update(SeoMetaRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $seo = SeoMeta::findOrFail($id);

            $data = $request->validated();

            $exists = SeoMeta::where('page_type', $data['page_type'])
                ->where('reference_id', $data['reference_id'] ?? null)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return $this->error(
                    'SEO already exists for this page.',
                    422
                );
            }

            $seo->update($data);

            DB::commit();

            return $this->success(
                'SEO updated successfully.',
                $seo->fresh()
            );
        } catch (ModelNotFoundException $e) {

            DB::rollBack();

            return $this->error(
                'SEO record not found.',
                404
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('SEO Update Error', [
                'id' => $id,
                'payload' => $request->all(),
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return $this->error(
                'Failed to update SEO record.',
                500
            );
        }
    }

    /**
     * Delete SEO
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $seo = SeoMeta::findOrFail($id);

            $seo->delete();

            DB::commit();

            return $this->success(
                'SEO deleted successfully.'
            );
        } catch (ModelNotFoundException $e) {

            DB::rollBack();

            return $this->error(
                'SEO record not found.',
                404
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('SEO Delete Error', [
                'id' => $id,
                'message' => $e->getMessage()
            ]);

            return $this->error(
                'Failed to delete SEO record.',
                500
            );
        }
    }
}
