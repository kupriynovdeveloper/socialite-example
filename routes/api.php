<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('users', UserController::class)->only(['index', 'show']);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);
});
