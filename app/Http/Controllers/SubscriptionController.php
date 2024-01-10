<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request)
    {
        $data = $request->validate([
            'plan_duration' => 'required|integer',
            'plan_name' => 'required|in:Basic,Premium,Pro',
            'price' => 'required|numeric',
            'saved_percentage' => 'required|string',
        ]);

        $subscription = Subscription::create($data);

        return response()->json($subscription, 201);
    }


    public function fetchSubscription($id){
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        return response()->json($subscription, 200);
    }


    public function updateSubscription(Request $request, $id){
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $data = $request->validate([
            'plan_duration' => 'integer',
            'plan_name' => 'in:Basic,Premium,Pro',
            'price' => 'numeric',
            'saved_percentage' => 'string',
        ]);

        $subscription->update($data);

        return response()->json($subscription, 200);
    }


    public function deleteSubscription($id){
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully'], 200);
    }

}
