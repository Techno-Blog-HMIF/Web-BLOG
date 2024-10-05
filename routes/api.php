<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;



Route::middleware('auth:api')->group(function () {
    Route::post('/follow', [FollowController::class, 'followUser']);
    Route::post('/unfollow', [FollowController::class, 'unfollowUser']);

    Route::prefix('articles')->group(function () {
        Route::get('/get/{id}', [ArticleController::class, 'index']);
        Route::post('/post', [ArticleController::class, 'store']);
        Route::put('/update/{id}', [ArticleController::class, 'update']);
        Route::delete('/delete/{id}', [ArticleController::class, 'destroy']);
        Route::get('/search', [ArticleController::class, 'search']);
        Route::get('/get', [CategoryController::class, 'index']);
    });

    Route::prefix('claps')->group(function () {
        Route::post('/clap', [ClapController::class, 'clap']);
        Route::post('/unclap', [ClapController::class, 'unclap']);
    });

    Route::get('/users', [AuthController::class, 'profile']);
    Route::get('/show/{id}', [AuthController::class, 'showProfile']);
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::middleware('checkRole:admin')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::post('/post', [CategoryController::class, 'store']);
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
        });
    });
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
