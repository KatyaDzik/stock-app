<?php

namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;

    public function getById($id): Category;

    public function getSubcategories($id): Category;
}
