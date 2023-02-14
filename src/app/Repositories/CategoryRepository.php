<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryIRepositoryInterface;

class CategoryRepository implements CategoryIRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::find($id);
    }
}
