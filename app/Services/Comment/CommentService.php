<?php

namespace App\Services\Comment;

use App\Models\Comment;

class CommentService
{
    public static function store(array $data): Comment
    {
        return Comment::create($data);
    }

    public static function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);

        return $comment;
    }
}
