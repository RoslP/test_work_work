<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreCategoryNameRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function store(StoreCategoryNameRequest $storeCategoryNameRequest): JsonResponse
    {
        $articleCategory = $storeCategoryNameRequest->validated();

        $category = $this->categoryService->createCategory($articleCategory['categoryName']);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Категория успешно создана',
                'data' => new CategoryResource($category)
            ],
            201
        );
    }
}
