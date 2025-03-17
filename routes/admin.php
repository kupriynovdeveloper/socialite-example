<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {
   Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
   Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
});
