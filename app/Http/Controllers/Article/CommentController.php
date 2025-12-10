<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(protected CommentRepository $commentRepository)
    {
    }

    public function store(CommentRequest $request): JsonResponse
    {
        $dataToSave = $request->validated();

        $this->commentRepository->saveCommentFromUser($dataToSave['user_id'],$dataToSave['content'], $dataToSave['article_id']);

        return response()->json();
    }
}
