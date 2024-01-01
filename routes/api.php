<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\FetchUserProfile; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



// API for login,register & forgot-password
Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login'); 
    Route::post('/register','register');
    Route::post('/forgot-password', 'forgotPassword');
});



// API for store user's data into Database,update the user's profile
Route::post('/store-profile', [ProfileController::class, 'store']); 
Route::put('/update-profile/{id}', [ProfileController::class, 'update']);


// fetch the user profile
Route::get('profiles/{id}', [FetchUserProfile::class, 'fetchUseProfile']);


