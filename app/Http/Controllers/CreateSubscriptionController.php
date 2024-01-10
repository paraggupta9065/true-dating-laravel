<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscribedUser;

class CreateSubscriptionController extends Controller
{
    public function purchaseSubscription(Request $request){
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Create subscription for user
        $subscription = Subscription::find($request->subscription_id);
        $user = User::find($request->user_id);

        if (!$subscription || !$user) {
            return response()->json(['error' => 'Invalid subscription or user.'], 400);
        }

        $startDate = now()->toDateString(); 
        $endDate = now()->addMonths($subscription->duration)->toDateString(); 

        // Create subscribed user record
        $subscribedUser = new SubscribedUser();
        $subscribedUser->subscription_id = $subscription->id;
        $subscribedUser->user_id = $user->id;
        $subscribedUser->start_date = $startDate;
        $subscribedUser->end_date = $endDate;
        $subscribedUser->transaction_id = $request->transaction_id;
        $subscribedUser->transaction_method = $request->transaction_method;
        $subscribedUser->transaction_status = 'completed';
        $subscribedUser->amount = $subscription->price; 
        $subscribedUser->save();

        return response()->json(['message' => 'Subscription purchased successfully.', 'subscribed_user' => $subscribedUser]);
    }


    public function fetchCurrentSubscriptionPlans(){

       
        $subscriptionPlans = Subscription::all();

        if ($subscriptionPlans->isEmpty()) {
            return response()->json(['message' => 'No subscription plans found.'], 404);
        }

        return response()->json(['subscription_plans' => $subscriptionPlans]);
    }
   

}
