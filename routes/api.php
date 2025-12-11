<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\CategoryController;
use App\Http\Controllers\Article\CommentController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category', function (){
        return CategoryResource::collection(Category::all())->resolve();
    });

    Route::post('/article',[ArticleController::class, 'store']);
    Route::get('/article/{title}', [ArticleController::class, 'findByName']);
    Route::get('/articles-all', [ArticleController::class, 'findAll']);
    Route::post('/articles/category', [ArticleController::class, 'findByCategory']);

    Route::post('/comment',[CommentController::class, 'store'])->middleware('throttle:5,1');
    Route::get('/comments/{article_id}', [CommentController::class, 'show']);
});
