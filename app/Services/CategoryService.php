<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {

    }
    public function createCategory(string $name): Model|Category
    {
       return $this->categoryRepository->firstOrCreateByName($name);
    }
}
