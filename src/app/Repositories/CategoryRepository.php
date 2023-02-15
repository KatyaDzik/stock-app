<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getById($id): Category
    {
        return Category::find($id);
    }

    public function getSubcategories($id): Category
    {
        return Category::with('subcategories')->find($id);
    }
}
