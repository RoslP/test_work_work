<?php

namespace App\Repositories;

use App\Models\Comment;

class BuildingRepository
{
    public const PRE_PAGE = 50;

    public function search(string $query)
    {
        $data = Comment::search($query, function () {

        })->get();
        echo 123;
        echo 123;
        echo 123;
        echo 123;
    }
}
