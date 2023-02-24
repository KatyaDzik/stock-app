<?php

namespace App\Services\Interfaces;

use App\Dto\ProductDto;
use App\Models\Product;

interface ProductServiceInterface
{
    /**
     * @param ProductDto $dto
     * @return Product
     */
    public function create(ProductDto $dto): Product;

    /**
     * @param int $id
     * @return Product
     */
    public function read(int $id): Product;

    /**
     * @param int $id
     * @param ProductDto $dto
     * @return Product
     */
    public function update(int $id, ProductDto $dto): Product;

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
