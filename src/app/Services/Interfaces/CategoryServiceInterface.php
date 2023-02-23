<?php

namespace App\Services\Interfaces;

use App\Dto\CategoryDto;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDto $data
     * @return array
     */
    public function create(CategoryDto $data): array;

    /**
     * @param int $id
     * @return array
     */
    public function read(int $id): array;


    /**
     * @param int $id
     * @param CategoryDto $data
     * @return array
     */
    public function update(int $id, CategoryDto $data): array;

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
