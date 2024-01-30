<?php

use App\Http\Controllers\ChatChannelController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\checkChatChannel;
use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\FetchLikeUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FetchProfile;
use App\Http\Controllers\FetchUsers;
use App\Http\Controllers\NearByUser;
use App\Http\Controllers\ProfileLikeController;
use App\Http\Controllers\sendMessage;
use App\Http\Controllers\SocialLogin;
use App\Http\Controllers\StoreUpdateProfile;
use App\Http\Controllers\SubscriptionController;
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
Route::post('/sign-up-mobile',[UserController::class,'signupWithMobile']);

Route::put('/update-password/{name}', [UserController::class, 'updatePassword']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);


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
Route::get('/fetch-unread-message-count', [ChatController::class, 'fetchUnreadMessageCount']);

// Fetch chat message 
Route::get('/fetch-chat-messages/{channelId}', [ChatController::class, 'fetchChatMessages']);

// Check-chat-channel
Route::get('/check-chat-channel/{userId}', [checkChatChannel::class, 'checkChatChannel']);

// Send the message
Route::post('/send-message/{channelId}', [sendMessage::class, 'sendMessage']);

// Fetch users: who-i-liked,who-liked-me
Route::get('/fetch-users-who-i-liked', [FetchLikeUsers::class, 'fetchUsersWhoILiked']);
Route::get('/fetch-users-who-liked-me', [FetchLikeUsers::class, 'fetchUsersWhoLikedMe']);

// Purchase Subscription
Route::post('/purchase-subscription', [CreateSubscriptionController::class, 'purchaseSubscription']);

// Fetch current subscription plans
Route::get('/fetch-current-subscription-plans', [CreateSubscriptionController::class, 'fetchCurrentSubscriptionPlans']);


// ==========================================================================================


// Admin API Started  From Here 

// crete the plan 
Route::post('/create-subscription', [SubscriptionController::class, 'createSubscription']);
Route::get('/fetch-subscription/{id}', [SubscriptionController::class, 'fetchSubscription']);
Route::put('/update-subscription/{id}', [SubscriptionController::class, 'updateSubscription']);
Route::delete('/delete-subscription/{id}', [SubscriptionController::class, 'deleteSubscription']);

Route::get('/fetch-subscribed-users', [FetchUsers::class, 'fetchSubscribedUsers']);
Route::get('/fetch-unsubscribed-users', [FetchUsers::class, 'fetchUnsubscribedUsers']);
Route::get('/fetch-all-users', [FetchUsers::class, 'fetchAllUsers']);




// Social Login Api 

// login with mobile number
Route::post('/login/mobile-number', [SocialLogin::class, 'mobileLogin']);
// login with email
Route::post('/login/email', [SocialLogin::class, 'emailLogin']);
// login with google 

// Route::get('/login/google', [SocialLogin::class, 'redirect'])->name('google.login');
// Route::get('/login/google/callback',[SocialLogin::class, 'callBackGoogle'])->name('google.callback');


Route::get('login/google', [SocialLogin::class, 'redirectToGoogle']);
Route::get('login/google/callback', [SocialLogin::class, 'handleGoogleCallback']);