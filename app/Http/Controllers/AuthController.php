<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthController extends Controller
{
    use ApiResponseTrait;
    /* ================= REGISTER (NO LOGIN) ================= */
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'phone'    => 'nullable|string|max:20',
                'password' => 'required|min:6',
            ]);

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
                'role'     => 'Customer',
            ]);

            DB::commit();

            return $this->success(
                'User registered successfully. Please login.',
                [],
                201
            );
        } catch (Exception $e) {

            DB::rollBack();

            return $this->error(
                'Registration failed',
                500,
                [$e->getMessage()]
            );
        }
    }

    /* ================= LOGIN ================= */
    // public function login(Request $request)
    // {
    //     try {
    //         $credentials = $request->only('email', 'password');

    //         if (! $token = auth('api')->attempt($credentials)) {
    //             return $this->error('Invalid credentials', 401);
    //         }

    //         return $this->success(
    //             'Login successful',
    //             [
    //                 'token' => $token,
    //                 'user'  => auth('api')->user(),
    //             ]
    //         );
    //     } catch (Exception $e) {
    //         return $this->error('Login failed', 500, [$e->getMessage()]);
    //     }
    // }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'email'    => 'required|email',
                'password' => 'required|string',
            ]);

            $credentials = [
                'email'    => $request->email,
                'password' => $request->password,
            ];

            if (! $token = auth('api')->attempt($credentials)) {
                return $this->error('Invalid credentials', 401);
            }

            $user = auth('api')->user();

            // Allow only Admin & Staff
            if (!in_array($user->role, ['Admin', 'Staff'])) {

                auth('api')->logout();

                return $this->error('You are not authorized to access the admin panel.', 403);
            }

            $user->load('permissions');

            return $this->success(
                'Login successful',
                [
                    'token_type'   => 'Bearer',
                    'access_token' => $token,
                    'expires_in'   => auth('api')->factory()->getTTL() * 60,
                    'user'         => $user,
                ]
            );
        } catch (Exception $e) {

            return $this->error('Login failed', 500, [$e->getMessage()]);
        }
    }


    /* ================= LOGOUT ================= */
    public function logout()
    {
        try {
            auth('api')->logout();
            return $this->success('Logged out successfully');
        } catch (Exception $e) {
            return $this->error('Logout failed', 500, [$e->getMessage()]);
        }
    }

    /* ================= ME ================= */
    public function me()
    {
        try {
            return $this->success(
                'User details',
                auth('api')->user()
            );
        } catch (Exception $e) {
            return $this->error('Failed to fetch user', 500);
        }
    }

    /* ===================== REFRESH ===================== */
    public function refresh()
    {
        return response()->json([
            'token' => auth('api')->refresh()
        ]);
    }

    public function changePassword(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'current_password'      => 'required|string',
                'new_password'          => 'required|string|min:8|confirmed',
            ], [
                'current_password.required' => 'Current password is required.',
                'new_password.required'     => 'New password is required.',
                'new_password.min'          => 'New password must be at least 8 characters.',
                'new_password.confirmed'    => 'Password confirmation does not match.',
            ]);

            if ($validator->fails()) {
                return $this->error(
                    'Validation failed.',
                    422,
                    $validator->errors()->all()
                );
            }

            $user = auth('api')->user();

            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return $this->error(
                    'Current password is incorrect.',
                    400
                );
            }

            // Prevent same password
            if (Hash::check($request->new_password, $user->password)) {
                return $this->error(
                    'New password cannot be the same as the current password.',
                    400
                );
            }

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return $this->success(
                'Password changed successfully.'
            );
        } catch (Exception $e) {

            return $this->error(
                'Failed to change password.',
                500,
                [$e->getMessage()]
            );
        }
    }
}
