<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        # 1. setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        # 2. cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        # 3. create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        # 4. cek keberhasilan
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        }

        # 5. cek gagal
        return response()->json([
            'success' => false,
            'message' => 'User creation failed'
        ], 409);
    }

    public function login(Request $request)
    {
        # 1. setup validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        # 2. cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        # 3. get kredensial dari request
        $credentials = $request->only('email', 'password');

        # 4. cek isFailed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            // alur mendapatkan token yaitu, dari credentials, lalu dicek, jika valid maka generate token
            // cek kredensial melalui auth lalu guard api (karena kita menggunakan guard api untuk jwt)

            // auth()->guard('api') berarti kita menggunakan guard 'api' yang sudah dikonfigurasi di config/auth.php
            // dengan kata lain ambil instance autentikasi yang menggunakan guard api, jadi semua operasi autentikasi berikutnya (login, attempt, check, logout) akan dilakukan menggunakan guard ini.
            // Mencoba melakukan autentikasi dengan credentials yang diberikan (biasanya email dan password).
            // Jika berhasil, mengembalikan token JWT (jika guard menggunakan JWT), atau true (jika session-based).
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah!'
            ], 401);
        }

        # 5. cek isSuccess
        return response()->json([
            'success' => true,
            'message' => 'Login Successfully!',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully!'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed!'
            ], 500);
        }
    }

}
