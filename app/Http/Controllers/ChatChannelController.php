<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatChannel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class ChatChannelController extends Controller
{
    public function fetchChatChannels()
    {
        $userId = Auth::id();

        // Fetch chat channels where the authenticated user is involved (user1_id or user2_id)
        $chatChannels = ChatChannel::where('user1_id', $userId)
                                   ->orWhere('user2_id', $userId)
                                   ->get();

        return response()->json(['chat_channels' => $chatChannels], 200);
    }
}
