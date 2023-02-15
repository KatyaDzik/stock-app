<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function getProducts($id)
    {
        return $this->getById($id)->products;
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function getSubcategories($id)
    {
        return $this->getById($id)->subcategories;
    }
}
