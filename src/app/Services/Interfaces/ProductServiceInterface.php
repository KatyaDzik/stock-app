<?php

namespace App\Services\Interfaces;

use App\Dto\ProductDto;
use App\Models\Product;

interface ProductServiceInterface
{
    /**
     * @param ProductDto $dto
     * @return void
     */
    public function create(ProductDto $dto): void;

    /**
     * @param int $id
     * @return Product
     */
    public function read(int $id): Product;

    /**
     * @param int $id
     * @param ProductDto $dto
     * @return void
     */
    public function update(int $id, ProductDto $dto): void;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
