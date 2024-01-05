<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // store and update user profile data 


    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|string',
            'Mobile' => 'required|string',
            'Password' => 'required|string',
            'reset_token' => 'string', 
            'fcm_token' => 'string',
            'video_intro' => 'string',
            'gender' => 'string',
            'looking_for' => 'string',
            'profession' => 'string',
            'relationship_status' => 'string',
            'country' => 'string',
            'city' => 'string',
            'current_location' => 'string',
            'home_location' => 'string',
            'body_type' => 'string',
            'excercise' => 'string',
            'kids' => 'boolean',
            'religion' => 'string',
            'high_school' => 'boolean',
            'trade_tech_school' => 'boolean',
            'in_college' => 'boolean',
            'ug_degree' => 'boolean',
            'graduate_degree' => 'boolean',
            'in_grade_school' => 'boolean',
            'push_notification_enabled' => 'boolean'  
        ]);

        // Create and store profile
        $profile = User::create($data);

        // Return a response
        return response()->json([
            'message' => 'Profile created successfully!',
            'data' => $profile
        ], 201);
    }


    public function update(Request $request, $id)
    {
        // Validate request data
        $data = $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|string',
            'Mobile' => 'required|string',
            'Password' => 'required|string',
            'reset_token' => 'string',
            'fcm_token' => 'string',
            'video_intro' => 'string',
            'gender' => 'string',
            'looking_for' => 'string',
            'profession' => 'string',
            'relationship_status' => 'string',
            'country' => 'string',
            'city' => 'string',
            'current_location' => 'string',
            'home_location' => 'string',
            'body_type' => 'string',
            'excercise' => 'string',
            'kids' => 'boolean',
            'religion' => 'string',
            'high_school' => 'boolean',
            'trade_tech_school' => 'boolean',
            'in_college' => 'boolean',
            'ug_degree' => 'boolean',
            'graduate_degree' => 'boolean',
            'in_grade_school' => 'boolean',
            'push_notification_enabled' => 'boolean'  
        ]);

        // Find the profile by ID
        $profile = User::find($id);

        // Check if profile exists
        if (!$profile) {
            return response()->json(['message' => 'Profile not found!'], 404);
        }

        // Update profile data
        $profile->update($data);

        // Return response
        return response()->json([
            'message' => 'Profile updated successfully!',
            'data' => $profile
        ], 200);
    }
}
