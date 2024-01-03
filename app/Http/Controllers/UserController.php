<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function FetchProfile($id)
    {
        $profile = User::find($id);
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }
        
        return new UserResource($profile);
    }
}
