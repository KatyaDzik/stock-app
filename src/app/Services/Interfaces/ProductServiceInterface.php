<?php

namespace App\Services\Interfaces;

use App\Dto\ProductDto;

interface ProductServiceInterface
{
    /**
     * @param ProductDto $dto
     * @return array
     */
    public function create(ProductDto $dto): array;


    /**
     * @param int $id
     * @return array
     */
    public function read(int $id): array;

    /**
     * @param int $id
     * @param ProductDto $dto
     * @return array
     */
    public function update(int $id, ProductDto $dto): array;


    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
