<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login(Request $request)
    {

        // 验证用户凭据
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // 生成 Token
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user->id,
                'token' => $token,
            ]);
        }

        // 验证失败
        return response()->json([
            'error' => 'Invalid email or password',
        ], 401);
    }
}
