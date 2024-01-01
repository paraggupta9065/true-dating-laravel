<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

            // Controller for create and update the user profile
class ProfileController extends Controller
{
    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'age' => 'required|integer',
            'gender' => 'required|string',
            'height' => 'required|integer',
            'status' => 'required|string',
            'professional_background' => 'required|string',
        ]);


        // Create and store profile
        $profile = Profile::create($data);


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
            'age' => 'required|integer',
            'gender' => 'required|string',
            'height' => 'required|integer',
            'status' => 'required|string',
            'professional_background' => 'required|string',
        ]);

        // Find the profile by ID
        $profile = Profile::find($id);

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
