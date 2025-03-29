<?php

// Public/Non-admin Controller
use App\Http\Controllers\Public\Vote\AlbumVoteController;
use App\Http\Controllers\Public\Album\FetchAlbumController;

// Admin Controller
use App\Http\Controllers\Admin\Album\FetchAlbumController as AdminFetchAlbumController;
use App\Http\Controllers\Admin\Album\DeleteAlbumController;

// Additional
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public/Non-admin Routes
Route::prefix('public')->group(function () {
    Route::get('/albums/search', FetchAlbumController::class);
    Route::post('/albums/{album}/vote', AlbumVoteController::class);
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/albums/search', AdminFetchAlbumController::class);
    Route::delete('/albums/{album}', DeleteAlbumController::class);
});
