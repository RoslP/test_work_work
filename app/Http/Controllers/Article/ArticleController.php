<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleRequest;
use App\Http\Requests\Article\FindArticleByCategoryNameRequest;
use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function index(Request $request): Response
    {
        $page = $request->query('page', 1);

        $articles = $this->articleRepository->getArticlesForIndexArticlePage();

        return Inertia::render('Dashboard', ['currentPage' => 'articles', 'articles' => $articles]);
    }

    public function show(Request $request): Response
    {
        $article = $this->articleRepository->getArticleByName($request->title);

        return Inertia::render('Dashboard', ['currentPage' => 'show', 'article' => $article,'currentUserId'=>auth()->user()->id]);
    }
    public function findByName(string $name): JsonResponse
    {
        return response()->json($this->articleRepository->findByName($name));
    }

    public function findAll(): JsonResponse
    {
        return response()->json($this->articleRepository->getArticlesForIndexArticlePage());
    }

    public function findByCategory(FindArticleByCategoryNameRequest $request): JsonResponse
    {
        $categories = $request->validated();

        return response()->json($this->articleRepository->findByCategory($categories['categories']));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->articleRepository->deleteArticleById($id);

        return response()->json();
    }

    public function update(int $id, ArticleRequest $articleRequest): JsonResponse
    {
        $this->articleRepository->updateArticleById($id, $articleRequest->validated());

        return response()->json();
    }
}
