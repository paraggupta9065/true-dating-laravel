<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatChannel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class checkChatChannel extends Controller
{
    public function checkChatChannel($userId)
{
    try {
       
        $authUserId = Auth::id();

        // Check if a chat channel exists 
        $chatChannel = ChatChannel::where(function ($query) use ($authUserId, $userId) {
            $query->where('user1_id', $authUserId)
                  ->where('user2_id', $userId);
        })->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('user1_id', $userId)
                  ->where('user2_id', $authUserId);
        })->first();

        // Return the chat channel if it exists 
        if ($chatChannel) {
            return response()->json(['chat_channel' => $chatChannel], 200);
        } else {
            return response()->json(['message' => 'Chat channel does not exist.'], 404);
        }

    } catch (\Exception $e) {
        
        Log::error('Error checking chat channel:', ['error' => $e->getMessage(), 'trace' => $e->getTrace()]);

        return response()->json(['error' => 'Failed to check chat channel.'], 500);
    }
}
}
