<?php

namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param $id
     * @return Category|null
     */
    public function getById($id): ?Category;

    /**
     * @param $id
     * @return Category|null
     */
    public function getSubcategories($id): ?Category;
}
