<?php

namespace App\Repositories\Interfaces;


use App\Dto\CategoryDto;
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

    /**
     * @param int $id
     * @param array $data
     * @return Category|null
     */
    public function update(int $id, array $data): ?Category;

    /**
     * @param CategoryDto $data
     * @return Category|null
     */
    public function save(CategoryDto $data): ?Category;

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool;
}
