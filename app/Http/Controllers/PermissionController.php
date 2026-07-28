<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        if ($permissions) {
            return response()->json([
                'code' => 200,
                'data' => $permissions,
                'message' => 'Permission fetched'
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'data' => [],
                'message' => 'Permission not found'
            ]);
        }
    }
}
