<?php

use App\Http\Controllers\ChatChannelController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\checkChatChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FetchProfile;
use App\Http\Controllers\NearByUser;
use App\Http\Controllers\ProfileLikeController;
use App\Http\Controllers\sendMessage;
use App\Http\Controllers\StoreUpdateProfile;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth API's
Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/sign-in', [UserController::class, 'signIn']);
Route::put('/update-password/{name}', [UserController::class, 'updatePassword']);

// Fetch Profile by ID API
Route::get('/fetch-profile{id}', [FetchProfile::class, 'fetchProfile']);

// Update or Store the profile data 
Route::put('/create-user-profile{id}', [StoreUpdateProfile::class, 'StoreUserProfile']);
Route::put('/update-profile{id}', [StoreUpdateProfile::class, 'UpdateUserProfile']);

// Fetch Near-by-users 
Route::get('/users/nearby', [NearByUser::class, 'NearbyUsers']);

// Upload & Delete the vidio 
Route::post('/upload-video', [VideoController::class, 'uploadVideo']);
Route::delete('/delete-video/{userId}', [VideoController::class, 'deleteVideo']);

// User like
Route::post('/like-user/{userId}', [ProfileLikeController::class, 'likeUser']);

// Fetch chat channel
Route::get('/fetch-chat-channels',[ChatChannelController::class,'fetchChatChannels']);

// Fetch unread messagr count
/*
    Chech the Auth User
Route::middleware('auth:api')->get('/fetch-unread-message-count', [ChatController::class, 'fetchUnreadMessageCount']);
*/
Route::get('/fetch-unread-message-count', [ChatController::class, 'fetchUnreadMessageCount']);


// Fetch chat message 
Route::get('/fetch-chat-messages/{channelId}', [ChatController::class, 'fetchChatMessages']);

// Check-chat-channel
Route::get('/check-chat-channel/{userId}', [checkChatChannel::class, 'checkChatChannel']);

// Send the message
Route::post('/send-message/{channelId}', [sendMessage::class, 'sendMessage']);


// ==========================================================================================


// Admin API Started  From Here 

// crete the plan 

