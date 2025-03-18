<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {
    Route::resource('posts', PostController::class)->names('admin.posts');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('comments', CommentController::class)->names('admin.comments');
});
