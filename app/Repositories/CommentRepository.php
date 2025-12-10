<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function saveCommentFromUser(int $userId, string $comment, int $articleId): void
    {
        Comment::create([
            'user_id' => $userId,
            'article_id' => $articleId,
            'content' => $comment,
        ]);
    }
}
