<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponseTrait;

    /* ================= INDEX ================= */

    public function index(Request $request)
    {
        try {
            $query = User::with('permissions');

            /* ================= SEARCH FILTER ================= */
            if ($request->filled('search')) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('role', 'LIKE', "%{$search}%");
                });
            }

            /* ================= PAGINATION ================= */
            $perPage = min($request->get('per_page', 10), 50);

            $users = $query
                ->where('role', 'Staff')
                ->latest()
                ->paginate($perPage);

            return $this->success('Users list', $users);
        } catch (Exception $e) {
            return $this->error('Failed to fetch users', 500, [$e->getMessage()]);
        }
    }

    /* ================= STORE ================= */

    private function generatePassword(): string
    {
        $length = rand(15, 20);
        return substr(
            str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),
            0,
            $length
        );
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name'           => 'required|string|max:255',
                'email'          => 'required|email|unique:users,email',
                'phone'          => 'nullable|string|max:20',
                'role'           => 'required|string',
                'permission_ids' => 'required|array|min:1',
                'permission_ids.*' => 'exists:permissions,id',
            ]);

            $plainPassword = $this->generatePassword();

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'role'     => $request->role,
                'password' => Hash::make('password'),
            ]);

            $user->permissions()->sync($request->permission_ids);

            DB::commit();

            return $this->success(
                'User created successfully',
                [
                    'user'     => $user->load('permissions'),
                    'password' => $plainPassword // send once
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('User creation failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= SHOW ================= */

    public function show($id)
    {
        try {
            $user = User::with('permissions')->findOrFail($id);
            return $this->success('User details', $user);
        } catch (Exception $e) {
            return $this->error('User not found', 404);
        }
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name'           => 'required|string|max:255',
                'phone'          => 'nullable|string|max:20',
                'role'           => 'required|string',
                'permission_ids' => 'required|array|min:1',
                'permission_ids.*' => 'exists:permissions,id',
            ]);

            $user->update([
                'name'  => $request->name,
                'phone' => $request->phone,
                'role'  => $request->role,
            ]);

            $user->permissions()->sync($request->permission_ids);

            DB::commit();

            return $this->success('User updated successfully', $user->load('permissions'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('User update failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= DELETE ================= */

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $user->permissions()->detach();
            $user->delete();

            DB::commit();

            return $this->success('User deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('User delete failed', 500, [$e->getMessage()]);
        }
    }
}
