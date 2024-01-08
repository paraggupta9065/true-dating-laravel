<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FetchProfile extends Controller
{
    public function fetchProfile($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        return response()->json(['data' => $user], 200);
    }
}
