<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function uploadVideo(Request $request)
    {
        // Validate request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video' => 'required|mimes:mp4,mov,avi|max:50000', // Max 50MB
        ]);

        // Retrieve user by ID
        $user = User::find($request->user_id);

        // Check if user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Store the video file in storage/app/public/videos directory
        $videoPath = $request->file('video')->store('public/videos');

        // Update the user's video_intro column with the video path
        $user->video_intro = $videoPath;
        $user->save();

        // Return a success response
        return response()->json(['message' => 'Video uploaded successfully', 'data' => $user], 201);
    }



    public function deleteVideo($userId)
    {
        // Retrieve user by ID
        $user = User::find($userId);

        // Check if user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if user has a video
        if (!$user->video_intro) {
            return response()->json(['message' => 'No video found for the user'], 400);
        }

        // Delete the video file from storage
        Storage::delete($user->video_intro);

        // Remove the video path from the user's video_intro column
        $user->video_intro = null;
        $user->save();

        // Return a success response
        return response()->json(['message' => 'Video deleted successfully'], 200);
    }
}
