<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ArticleRepository
{
    public function createNewArticle(array $data): Article|Model
    {
       return  Article::create($data);
    }

    public function findExistingArticleByTitle(string $title): bool
    {
        return Article::where('title', $title)->exists();
    }

    public function getArticlesForIndexArticlePage()
    {
        return Article::select(['title','users.name as author', 'categories.name as name'])
            ->join('categories', 'categories.id', '=', 'articles.category_id')
            ->join('users', 'users.id', '=', 'articles.author_id')
            ->get();
    }
}
