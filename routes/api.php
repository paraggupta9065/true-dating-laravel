<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\fetchNearbyUser;
use App\Http\Controllers\AuthController;
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

// fetch the user profile
Route::get('fetch-profile{id}', [UserController::class, 'FetchProfile']);

// create/store and update user profile 
Route::post('/store-profile', [UserProfileController::class, 'store']);
Route::put('/update-profile/{id}', [UserProfileController::class, 'update']);

// fetch the near by user 
Route::get('/fetch-nearby-users', [fetchNearbyUser::class, 'fetchNearbyUsers']);


// Auth Api 
Route::post('/signup', [AuthController::class, 'signUp']);
Route::post('/signin', [AuthController::class, 'signIn']);