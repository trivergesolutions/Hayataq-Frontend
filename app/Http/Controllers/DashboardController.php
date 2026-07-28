<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard()
    {
        /* =========================
        1. COUNTS
        ==========================*/
        $counts = [
            'products'   => DB::table('products')->count(),
            'enquiries'  => DB::table('enquiries')->count(),
            'articles'   => DB::table('blogs')->count(),
            'categories' => DB::table('categories')->count(),
        ];

        /* =========================
        2A. LEFT GRAPH
        Month-wise top product by enquiries
        ==========================*/
        $topProductMonthly = DB::select("
            SELECT month, product_id, total_enquiries
            FROM (
                SELECT
                    DATE_FORMAT(e.created_at, '%Y-%m') AS month,
                    e.product_id,
                    COUNT(*) AS total_enquiries,
                    ROW_NUMBER() OVER (
                        PARTITION BY DATE_FORMAT(e.created_at, '%Y-%m')
                        ORDER BY COUNT(*) DESC
                    ) AS rn
                FROM enquiries e
                WHERE e.product_id IS NOT NULL
                GROUP BY month, e.product_id
            ) t
            WHERE rn = 1
            ORDER BY month
        ");

        /* =========================
        2B. RIGHT GRAPH
        Month-wise total enquiries
        ==========================*/
        $monthlyEnquiries = DB::table('enquiries')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        /* =========================
        3. LATEST ENQUIRIES
        With user name, email, phone
        ==========================*/

        $currentMonth = now()->format('Y-m');
        $lastMonth    = now()->subMonth()->format('Y-m');

        $baseQuery = DB::table('enquiries as e')
            ->join('users as u', 'u.id', '=', 'e.user_id')
            ->leftJoin('products as p', 'p.id', '=', 'e.product_id')
            ->select(
                'e.id',
                'e.message',
                'e.status',
                'e.created_at',

                'u.name  as user_name',
                'u.email as user_email',
                'u.phone as user_phone',

                'p.name as product_name'
            );

        $monthQuery = (clone $baseQuery)
            ->whereRaw("DATE_FORMAT(e.created_at, '%Y-%m') = ?", [$currentMonth]);

        if (!$monthQuery->exists()) {
            $monthQuery = (clone $baseQuery)
                ->whereRaw("DATE_FORMAT(e.created_at, '%Y-%m') = ?", [$lastMonth]);
        }

        $latestEnquiries = $monthQuery
            ->orderByDesc('e.created_at')
            ->paginate(10);

        /* =========================
        4. CATEGORY PRODUCT COUNT
        ==========================*/
        $categoryChart = DB::table('categories as c')
            ->join('category_product as cp', 'cp.category_id', '=', 'c.id')
            ->select(
                'c.id',
                'c.name',
                DB::raw('COUNT(cp.product_id) AS total_products')
            )
            ->where('c.type', 'product')
            ->groupBy('c.id', 'c.name')
            ->orderByDesc('total_products')
            ->get();

        /* =========================
        FINAL RESPONSE
        ==========================*/
        return response()->json([
            'counts' => $counts,

            'graphs' => [
                'top_product_monthly' => $topProductMonthly,
                'monthly_enquiries'   => $monthlyEnquiries,
            ],

            'latest_enquiries' => $latestEnquiries,

            'category_chart' => $categoryChart,
        ]);
    }
}
