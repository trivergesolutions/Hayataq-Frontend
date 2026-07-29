<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Exception;

class SystemCommandController extends Controller
{
    use ApiResponseTrait;

    public function optimizeClear(Request $request)
    {
        try {

            // 🔒 Extra protection (recommended)
            if ($request->header('X-SYSTEM-KEY') !== config('app.system_key')) {
                return $this->error('Unauthorized system access', 403);
            }

            // 🔒 Role check (example)
            if (!auth()->user() || auth()->user()->role !== 'Admin') {
                return $this->error('Permission denied', 403);
            }

            Artisan::call('optimize:clear');

            return $this->success(
                'System cache cleared successfully',
                [
                    'command' => 'optimize:clear',
                    'output'  => Artisan::output()
                ]
            );
        } catch (Exception $e) {
            return $this->error(
                'Failed to clear system cache',
                500,
                [$e->getMessage()]
            );
        }
    }
}
