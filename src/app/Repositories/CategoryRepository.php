<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function getById($id): ?Category
    {
        return Category::findOrFail($id);
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function getSubcategories($id): ?Category
    {
        return Category::with('subcategories')->find($id);
    }
}
