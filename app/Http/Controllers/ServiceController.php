<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceEnquiry;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        try {

            $query = ServiceEnquiry::with([
                'user:id,name,email,phone'
            ]);

            // Search (Name, Email, Phone)
            if ($request->filled('search')) {

                $search = $request->search;

                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                });
            }

            /* ================= SERVICE FILTER ================= */
            if ($request->filled('service')) {
                $query->where('service', 'LIKE', '%' . $request->service . '%');
            }

            /* ================= DATE RANGE FILTER ================= */
            if ($request->filled('from_date') && $request->filled('to_date')) {

                $query->whereBetween('created_at', [
                    $request->from_date . ' 00:00:00',
                    $request->to_date . ' 23:59:59'
                ]);
            } elseif ($request->filled('from_date')) {

                $query->whereDate('created_at', '>=', $request->from_date);
            } elseif ($request->filled('to_date')) {

                $query->whereDate('created_at', '<=', $request->to_date);
            }

            /* ================= PAGINATION ================= */
            $services = $query
                ->latest()
                ->paginate($request->get('per_page', 10));

            return response()->json([
                'code' => 200,
                'data' => $services,
                'message' => 'Data found'
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'code' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
