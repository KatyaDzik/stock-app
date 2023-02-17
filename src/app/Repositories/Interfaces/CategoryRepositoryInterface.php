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
     * @param int $id
     * @return Category|null
     */
    public function getById(int $id): ?Category;


    /**
     * @param int $id
     * @return Category|null
     */
    public function getSubcategories(int $id): ?Collection;
}
