<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// open the index.php file when server is start
/* 
    Route::get('/', function () {
        return response()->file(public_path('index.php'));
    });
*/

// open the index.php file when enter URL like -> http://127.0.0.1:8000/index
Route::get('/index', function () {
    return response()->file(public_path('index.php'));
});
