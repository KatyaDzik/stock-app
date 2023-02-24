<?php

namespace App\Services\Interfaces;

use App\Dto\CategoryDto;
use App\Models\Category;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDto $data
     * @return Category
     */
    public function create(CategoryDto $data): Category;

    /**
     * @param int $id
     * @return Category
     */
    public function read(int $id): Category;

    /**
     * @param int $id
     * @param CategoryDto $data
     * @return Category
     */
    public function update(int $id, CategoryDto $data): Category;

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
