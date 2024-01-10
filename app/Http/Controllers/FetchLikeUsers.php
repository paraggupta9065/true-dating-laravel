<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileLike;
use Illuminate\Support\Facades\Auth;

class FetchLikeUsers extends Controller
{
    public function fetchUsersWhoILiked(){

        $userId = Auth::id();

        $likedUsers = ProfileLike::where('liked_by', $userId)->with('likedUser')->get();

        return response()->json(['liked_users' => $likedUsers]);
    }


    public function fetchUsersWhoLikedMe(){
        
        $userId = Auth::id();

        $usersLikedMe = ProfileLike::where('liked_to', $userId)->with('likingUser')->get();

        return response()->json(['users_liked_me' => $usersLikedMe]);
    }
}
