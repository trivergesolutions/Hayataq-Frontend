<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accessory;

class AccessoryController extends Controller
{
    private function sanitizeFileName($filename)
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Replace spaces and special characters with underscore
        $name = preg_replace('/[^A-Za-z0-9\-]/', '_', $name);

        // Remove multiple underscores
        $name = preg_replace('/_+/', '_', $name);

        return $name . '.' . $extension;
    }

    public function index()
    {
        try {
            // $data = Accessory::latest()->get();
            $data = Accessory::withCount('products')->latest()->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
                'document' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx',
                'products' => 'array'
            ]);

            $data = [
                'name' => $request->name
            ];

            // Upload Image
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $originalName = $this->sanitizeFileName($file->getClientOriginalName());
                $filename = time() . '_' . $originalName;

                $file->move(public_path('accessary'), $filename);

                $data['image'] = 'accessary/' . $filename;
            }

            // Upload Document
            if ($request->hasFile('document')) {
                $file = $request->file('document');

                $originalName = $this->sanitizeFileName($file->getClientOriginalName());
                $filename = time() . '_' . $originalName;

                $file->move(public_path('accessary'), $filename);

                $data['document'] = 'accessary/' . $filename;
            }

            $accessory = Accessory::create($data);
            // Attach products
            $accessory->products()->sync($request->products);

            return response()->json([
                'status' => true,
                'message' => 'Accessory created successfully',
                'data' => $accessory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $accessory = Accessory::with('products')->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => $accessory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $accessory = Accessory::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
                'document' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx',
                'products' => 'nullable|array',
                'products.*' => 'exists:products,id'
            ]);

            $data = [
                'name' => $request->name
            ];

            /* Upload Image */
            if ($request->hasFile('image')) {

                // Delete old image if exists
                if ($accessory->image && file_exists(public_path($accessory->image))) {
                    unlink(public_path($accessory->image));
                }

                $file = $request->file('image');
                $originalName = $this->sanitizeFileName($file->getClientOriginalName());
                $filename = time() . '_' . $originalName;

                $file->move(public_path('accessary/image'), $filename);

                $data['image'] = 'accessary/image/' . $filename;
            }

            /* Upload Document */
            if ($request->hasFile('document')) {

                // Delete old document if exists
                if ($accessory->document && file_exists(public_path($accessory->document))) {
                    unlink(public_path($accessory->document));
                }

                $file = $request->file('document');
                $originalName = $this->sanitizeFileName($file->getClientOriginalName());
                $filename = time() . '_' . $originalName;

                $file->move(public_path('accessary'), $filename);

                $data['document'] = 'accessary/' . $filename;
            }

            $accessory->update($data);

            /* Sync products only if provided */
            if ($request->has('products')) {
                $accessory->products()->sync($request->products);
            }

            // Reload relation
            $accessory->load('products');

            return response()->json([
                'status' => true,
                'message' => 'Accessory updated successfully',
                'data' => $accessory
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $accessory = Accessory::findOrFail($id);
            $accessory->delete();

            return response()->json([
                'status' => true,
                'message' => 'Accessory deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
