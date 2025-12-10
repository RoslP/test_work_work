<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService, protected ArticleRepository $articleRepository)
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

    public function index(): Response
    {
        $articles = ArticleResource::collection($this->articleRepository->getArticlesForIndexArticlePage());

        return Inertia::render('Dashboard', ['currentPage' => 'articles', 'articles' => $articles]);
    }
}
