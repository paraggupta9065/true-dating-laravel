<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    
    protected $table = 'chat_message';

    protected $fillable = [
        'sender_id',
        'channel_id',
        'message',
        'message_type',
        'is_seen',
    ];
}
