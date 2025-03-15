<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'is_published' => $this->is_published,
            'author' => $this->profile_id,
            'image_id' => $this->image_id,
            'view' => $this->view,
            'no_comments' => $this->no_comments,
            'published_at' => $this->published_at,
            'comments' => $this->when($request->has('include_comments'), function () {
                return CommentResource::collection($this->comments);
            }),
        ];
    }
}
