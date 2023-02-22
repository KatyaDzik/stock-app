<?php

namespace App\Services\PostServiceInterface;

use App\Dto\CategoryDto;
use App\Models\Category;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDto $data
     * @return Category|null
     */
    public function create(CategoryDto $data): ?Category;

    /**
     * @param int $id
     * @return Category|null
     */
    public function read(int $id): ?Category;


    /**
     * @param int $id
     * @param CategoryDto $data
     * @return Category|null
     */
    public function update(int $id, CategoryDto $data): ?Category;

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool;
}
