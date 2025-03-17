<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all())->resolve();
        return inertia('Admin/Post/Index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }
}
