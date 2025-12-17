<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Model;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $articleRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function tryToSaveArticle(array $data): Model
    {
        $existing = $this->articleRepository->findExistingArticleByTitle($data['title']);

        if($existing){
            throw new \Exception("Статья с таким названием уже существует");
        }


        return $this->articleRepository->createNewArticle(array_merge($data, ['author_id'=>auth()->user()->id]));
    }
}
