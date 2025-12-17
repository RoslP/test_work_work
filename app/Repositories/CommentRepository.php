<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Collection;

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

    public function getCommentsByArticleId(int $articleId): Collection
    {
         return Comment::select(['comments.id as id', 'comments.content as comment', 'users.name as author', 'comments.created_at as created_at'])
            ->where('article_id', $articleId)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->orderBy('comments.created_at', 'desc')
            ->get();
    }
}
