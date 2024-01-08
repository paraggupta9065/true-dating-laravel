<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StoreUpdateProfile extends Controller
{
    public function StoreUserProfile(Request $request, $id)
    {
        Log::info('Received request data:', $request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'gender' => 'nullable|string',
            'looking_for' => 'nullable|string',
            'profession' => 'nullable|string',
            'relationship_status' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'current_location' => 'nullable|string',
            'home_location' => 'nullable|string',
            'body_type' => 'nullable|string',
            'excercise' => 'nullable|string',
            'kids' => 'nullable|boolean',
            'religion' => 'nullable|string',
            'high_school' => 'nullable|boolean',
            'trade_tech_school' => 'nullable|boolean',
            'in_college' => 'nullable|boolean',
            'ug_degree' => 'nullable|boolean',
            'graduate_degree' => 'nullable|boolean',
            'in_grade_school' => 'nullable|boolean',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            Log::error('User not found with ID: ' . $id);
            return response()->json(['message' => 'User not found'], 404);
        }

        // Attempt to update the user profile
        try {
            $user->update($validatedData);
            Log::info('User profile updated successfully for user ID: ' . $id);
            return response()->json(['message' => 'User profile updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update user profile for user ID: ' . $id . '. Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update user profile'], 500);
        }
    }





    public function UpdateUserProfile(Request $request, $id)
    {
        // Validate the request data dynamically
        $validatedData = $request->validate([
            '*.field' => 'required|string',
            '*.value' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            Log::error('User not found with ID: ' . $id);
            return response()->json(['message' => 'User not found'], 404);
        }

        // Dynamically update user profile fields based on the request data
        try {
            foreach ($validatedData as $data) {
                $field = $data['field'];
                $value = $data['value'];
                
                // Check if the field exists in the users table
                if (array_key_exists($field, $user->getAttributes())) {
                    $user->$field = $value;
                } else {
                    Log::warning('Invalid field specified: ' . $field);
                }
            }
            
            // Save the updated user profile
            $user->save();

            Log::info('User profile updated successfully for user ID: ' . $id);
            return response()->json(['message' => 'User profile updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update user profile for user ID: ' . $id . '. Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update user profile', 'error' => $e->getMessage()], 500);
        }
    }
}
