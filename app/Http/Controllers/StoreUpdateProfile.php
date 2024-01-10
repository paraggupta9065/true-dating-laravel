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

        $user = User::find($id);

        if (!$user) {
            Log::error('User not found with ID: ' . $id);
            return response()->json(['message' => 'User not found'], 404);
        }

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
       
        $validatedData = $request->validate([
            '*.field' => 'required|string',
            '*.value' => 'required|string',
        ]);

        $user = User::find($id);

        if (!$user) {
            Log::error('User not found with ID: ' . $id);
            return response()->json(['message' => 'User not found'], 404);
        }

        
        try {
            foreach ($validatedData as $data) {
                $field = $data['field'];
                $value = $data['value'];
                
                if (array_key_exists($field, $user->getAttributes())) {
                    $user->$field = $value;
                } else {
                    Log::warning('Invalid field specified: ' . $field);
                }
            }
            
            $user->save();

            Log::info('User profile updated successfully for user ID: ' . $id);
            return response()->json(['message' => 'User profile updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update user profile for user ID: ' . $id . '. Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update user profile', 'error' => $e->getMessage()], 500);
        }
    }
}
