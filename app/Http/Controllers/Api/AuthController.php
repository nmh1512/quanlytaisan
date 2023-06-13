<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ], [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu có ít nhất 8 ký tự',
            ]);
            if ($validator->fails()) {
                // Nếu dữ liệu không hợp lệ, trả về lỗi 422 Unprocessable Entity
                return response()->json(['errors' => $validator->errors()], 422);
            }

            if (!Auth::attempt($request->all())) {
                
                return response()->json([
                    'message' => 'Unauthorized'
                ]);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;
            // $user = new UserResource(Auth::user());
            return response()->json([
                'data' => $user,
                'access_token' => $token
            ]);

        } catch (Exception $e) {
            Log::error('Error '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
    }
    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['message' => 'User logged out successfully']);
    }
    public function getToken(User $user) {
        try {
            $token = $user->tokens;
            return response()->json([
                'access_token' => $token
            ]);
        } catch (Exception $e) {
            Log::error('Error '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
    }
}
