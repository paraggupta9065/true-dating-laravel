<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileLike;
use Illuminate\Support\Facades\Auth;
class ProfileLikeController extends Controller
{
    public function likeUser($userId, Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Create a new like record
        $like = new ProfileLike();
        $like->liked_by = $user->id;  // Ensure that the authenticated user ID is used
        $like->liked_to = $userId;    // Use the provided $userId
        $like->save();

        // Return a success response
        return response()->json(['message' => 'User liked successfully', 'data' => $like], 201);
    }
}
