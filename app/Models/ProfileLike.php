<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLike extends Model
{
    use HasFactory;


    protected $table = 'profile_likes';

    protected $fillable = [
        'liked_by',
        'liked_to',
    ];


    public function likedBy()
    {
        return $this->belongsTo(User::class, 'liked_by');
    }

    
    
    public function likedTo()
    {
        return $this->belongsTo(User::class, 'liked_to');
    }
}
