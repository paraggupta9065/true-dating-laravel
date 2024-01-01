<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile; 
use App\Http\Resources\fetchProfile;

            // Controller for fetch the user profile
class FetchUserProfile extends Controller
{

    public function fetchUseProfile($id = null)
    {
        if (!$id) {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            $profile = $user->profile;
        } else {
            $profile = Profile::find($id);
            
            if (!$profile) {
                return response()->json(['message' => 'Profile not found'], 404);
            }
        }
        
        return new fetchProfile($profile);
    }
}
