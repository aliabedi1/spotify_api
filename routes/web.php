<?php

use App\Http\Controllers\AlbumsController;
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
Route::prefix('albums')->as('albums')->group(function () {
    Route::get('/', [AlbumsController::class, 'index'])->name('.index');
    Route::post('/select/{album}', [AlbumsController::class, 'select'])->name('.select');
    Route::get('/selected', [AlbumsController::class, 'selected'])->name('.selected');
    Route::delete('/delete/{album}', [AlbumsController::class, 'delete'])->name('.delete');
    Route::get('/deleted', [AlbumsController::class, 'deleted'])->name('.deleted');
    Route::post('/recycle/{album}', [AlbumsController::class, 'recycle'])->withTrashed()->name('.recycle');
    Route::get('/recover-last', [AlbumsController::class, 'deleted'])->name('.deleted');
});


