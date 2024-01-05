<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users',
            'Password' => 'required|min:6',
            // 'Mobile' => 'required|unique:users',
        ]);

        $user = User::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            // 'Mobile' => $request->Mobile,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);
    
        $credentials = $request->only('Email', 'Password');
    
        if (Auth::attempt($credentials)) {
            // User exists in the database
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
    
            return response()->json([
                'status' => 'success',
                'message' => 'User exists',
                'data' => [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => $tokenResult->token->expires_at,
                    'user' => $user
                ]
            ]);
        } else {
            // User does not exist or incorrect credentials
            return response()->json([
                'status' => 'error',
                'message' => 'User does not exist or incorrect credentials',
            ], 401);
        }
    }

}
