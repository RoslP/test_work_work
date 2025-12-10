<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;

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
}
