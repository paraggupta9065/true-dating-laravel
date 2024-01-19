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
 

   
    public function googleLogin()
    {
        $user = Socialite::driver('google')->user();

        $socialLogin = SocialLogin::where('provider', 'google')
            ->where('provider_id', $user->id)
            ->first();

        if ($socialLogin) {
            $existingUser = $socialLogin->user;
            Auth::login($existingUser);

            $token = $existingUser->createToken('google-login')->plainTextToken;

            return response()->json(['token' => $token, 'message' => 'Login successful']);
        } else {
           
            $newUser = User::create([
                'email' => $user->email,
            ]);

            $newSocialLogin = $newUser->socialLogins()->create([
                'provider' => 'google',
                'provider_id' => $user->id,
            ]);

            Auth::login($newUser);

            $token = $newUser->createToken('google-login')->plainTextToken;

            return response()->json(['token' => $token, 'message' => 'Login successful']);
        }
    }

}
