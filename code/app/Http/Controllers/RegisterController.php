<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');

        // 檢查參數正確嗎?
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6',
        ]);

        //驗證失敗
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // 存進user
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
        ]);

        //驗證成功
        return response()->json([
            'message' => 'Registration successful!',
        ], 201);
    }
}
