<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video' => 'required|mimes:mp4,mov,avi|max:50000', // Max 50MB
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Store the video file in storage/app/public/videos directory
        $videoPath = $request->file('video')->store('public/videos');

        // Update the user's video_intro column with the video path
        $user->video_intro = $videoPath;
        $user->save();

        return response()->json(['message' => 'Video uploaded successfully', 'data' => $user], 201);
    }



    public function deleteVideo($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!$user->video_intro) {
            return response()->json(['message' => 'No video found for the user'], 400);
        }

        // Delete the video file from storage
        Storage::delete($user->video_intro);

        // Remove the video path from the user's video_intro column
        $user->video_intro = null;
        $user->save();

        return response()->json(['message' => 'Video deleted successfully'], 200);
    }
}
