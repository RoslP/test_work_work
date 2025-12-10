<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\ArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService)
    {
    }

    public function store(ArticleRequest $articleRequest): JsonResponse
    {
        try{
            $article = $this->articleService->tryToSaveArticle($articleRequest->validated());

            return response()->json($article, 201);
        }
        catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }
}
