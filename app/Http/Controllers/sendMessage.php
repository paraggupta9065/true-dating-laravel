<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatChannel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class sendMessage extends Controller
{
    public function sendMessage(Request $request, $channelId)
{
    try {
       
        $validatedData = $request->validate([
            'message' => 'required|string|max:3000', 
        ]);

        $senderId = Auth::id();

        $chatChannel = ChatChannel::find($channelId);
        
        if (!$chatChannel) {
            return response()->json(['error' => 'Chat channel not found.'], 404);
        }

        // chat message
        $chatMessage = new ChatMessage();
        $chatMessage->chat_channel_id = $channelId;
        $chatMessage->sender_id = $senderId;
        $chatMessage->message = $validatedData['message'];
        $chatMessage->save();

        return response()->json(['message' => 'Message sent successfully.', 'chat_message' => $chatMessage], 201);

    } catch (\Exception $e) {

        Log::error('Error sending message:', ['error' => $e->getMessage(), 'trace' => $e->getTrace()]);
        return response()->json(['error' => 'Failed to send message.'], 500);
    }
}
}
