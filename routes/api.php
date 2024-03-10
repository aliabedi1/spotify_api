<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpotifyAuthController;
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


Route::get('/login', [
    SpotifyAuthController::class,
    'login'
])
    ->name('login');


Route::get('/login/callback', [
    SpotifyAuthController::class,
    'callback'
])
    ->name('callback');

Route::get('home/{token}', [
    HomeController::class,
    'index'
])
    ->name('home');

