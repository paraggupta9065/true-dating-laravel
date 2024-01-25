<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class SocialLogin extends Controller
{
    public function mobileLogin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric',
        ]);

        $user = Auth::getProvider()->retrieveByCredentials(['mobile' => $request->mobile]);

        if ($user) {
            return response()->json(['status' => 'success', 'message' => 'Login successful'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }


    public function emailLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Auth::getProvider()->retrieveByCredentials(['email' => $request->email]);

        if ($user) {
            return response()->json(['status' => 'success', 'message' => 'Login successful'], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
 

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // If the user doesn't exist, you may create a new user account
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(str_random(16)),
                ]);
            }

            Auth::login($user);

            $token = $user->createToken('GoogleToken')->accessToken;

            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}
