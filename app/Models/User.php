<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'Name',
        'Email',
        'Mobile',
        'Password',
        'reset_token',
        'fcm_token',
        'video_intro',
        'gender',
        'looking_for',
        'profession',
        'relationship_status',
        'country',
        'city',
        'current_location',
        'home_location',
        'body_type',
        'excercise',
        'kids',
        'religion',
        'high_school',
        'trade_tech_school',
        'in_college',
        'ug_degree',
        'graduate_degree',
        'in_grade_school',
        'push_notification_enabled'
    ];

}
