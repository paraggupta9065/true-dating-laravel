<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{
    public function fetchUnreadMessageCount(){
        $userId = Auth::id(); 

        // Fetch the unread message count for each chat channel
        $unreadMessageCounts = ChatMessage::where('is_seen', false)
                                          ->groupBy('channel_id')
                                          ->selectRaw('channel_id, count(*) as unread_count')
                                          ->get();

        return response()->json(['unread_message_counts' => $unreadMessageCounts], 200);
    }


    public function fetchChatMessages($channelId){
        try {
            $userId = Auth::id();

            // Fetch all chat messages for the specified chat channel ID
            $chatMessages = ChatMessage::where('channel_id', $channelId)
                                       ->orderBy('created_at', 'asc')
                                       ->get();

            return response()->json(['chat_messages' => $chatMessages], 200);

        } catch (\Exception $e) {

            Log::error('Error fetching chat messages:', ['error' => $e->getMessage(), 'trace' => $e->getTrace()]);

            return response()->json(['error' => 'Failed to fetch chat messages.'], 500);
        }
    }
}
