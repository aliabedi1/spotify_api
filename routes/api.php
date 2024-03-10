<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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


Route::as('login')->prefix('/login')->group(function () {
    Route::get('/', function () {
        return Socialite::driver('spotify')->redirect();
    })->name('index');

    Route::get('/callback', function () {
        $user = Socialite::driver('spotify')->user();
    })->name('callback');
});

