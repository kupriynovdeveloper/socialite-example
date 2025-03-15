<?php

namespace App\Http\Controllers\Api;

use App\Filters\PostFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\StorePostRequest;
use App\Http\Requests\Api\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Post\PostService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Описывает возвращаемые поля модели
 *
 * @link PostResource::toArray()
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $posts = Post::filter(data: $data)->get();

        return PostResource::collection($posts)->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'id' => PostService::store(data: $data)->id,
            'status' => 'success',
            'code' => Response::HTTP_CREATED,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        return response()->json([
            'id' => PostService::update(post: $post, data: $data)->id,
            'status' => 'success',
            'code' => Response::HTTP_ACCEPTED,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['status' => 'success']);
    }
}
