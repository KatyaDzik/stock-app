<?php

namespace App\Services\PostServiceInterface;

use App\Dto\ProductDto;
use App\Models\Product;

interface ProductServiceInterface
{
    /**
     * @param ProductDto $dto
     * @return Product|null
     */
    public function create(ProductDto $dto): ?Product;


    /**
     * @param int $id
     * @return Product|null
     */
    public function read(int $id): ?Product;

    /**
     * @param array $data
     * @param int $id
     * @return Product|null
     * @throws \Exception
     */
    public function update(int $id, ProductDto $dto): ?Product;


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
