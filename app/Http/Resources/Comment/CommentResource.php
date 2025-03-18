<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'text' => $this->text,
            'parent' => $this->parent_id,
            'status' => $this->status,
            'view' => $this->view,
            'file_id' => $this->file_id,
            'author' => $this->profile,
            'post' => $this->post
        ];
    }
}
