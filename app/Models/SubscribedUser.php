<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'user_id',
        'start_date',
        'end_date',
        'transaction_id',
        'transaction_method',
        'transaction_status',
        'amount',
        'active',
    ];

   
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
