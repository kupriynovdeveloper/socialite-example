<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'author' => $this->profile,
            'image_id' => $this->image_id,
            'view' => $this->view,
            'no_comments' => $this->no_comments,
            'published_at' => (new Carbon($this->published_at))->format('Y-m-d H:i'),
            'category' => $this->category,
            'comments' => $this->when($request->has('include_comments'), function () {
                return CommentResource::collection($this->comments);
            }),
        ];
    }
}
