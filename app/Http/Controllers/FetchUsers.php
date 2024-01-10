<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscribedUser;
use App\Models\User;

class FetchUsers extends Controller
{
    public function fetchSubscribedUsers(){
        
        $subscribedUsers = SubscribedUser::all();

        if ($subscribedUsers->isEmpty()) {
            return response()->json(['message' => 'No subscribed users found.'], 404);
        }

        return response()->json(['subscribed_users' => $subscribedUsers]);
    }


    public function fetchAllUsers(){
        
        $users = User::all();

        $subscribedUsers = SubscribedUser::all();

        if ($users->isEmpty() && $subscribedUsers->isEmpty()) {
            return response()->json(['message' => 'No users found.'], 404);
        }

        return response()->json([
            'users' => $users,
            'subscribed_users' => $subscribedUsers
        ]);
    }

    public function fetchUnsubscribedUsers(){


        $unsubscribedUsers = User::whereNotIn('id', function ($query) {
            $query->select('user_id')->from('subscribed_users');
        })->get();


        if ($unsubscribedUsers->isEmpty()) {
            return response()->json(['message' => 'No unsubscribed users found.'], 404);
        }

        
        return response()->json(['unsubscribed_users' => $unsubscribedUsers]);
    }
}
