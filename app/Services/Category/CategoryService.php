<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService
{
    public static function store(array $data): Category
    {
        return Category::create($data);
    }

    public static function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }
}
