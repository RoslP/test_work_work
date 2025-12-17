<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository
{
    public function firstOrCreateByName(string $name): Model|Category
    {
        return Category::firstOrCreate(['name' => $name]);
    }
}
