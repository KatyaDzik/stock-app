<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\PostServiceInterface\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private ProductRepository $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param ProductDto $dto
     * @return Product|null
     */
    public function create(ProductDto $dto): ?Product
    {
        return $this->repository->save($dto);
    }


    /**
     * @param int $id
     * @return Product|null
     */
    public function read(int $id): ?Product
    {
        return $this->repository->getById($id);
    }


    /**
     * @param int $id
     * @param ProductDto $dto
     * @return Product|null
     */
    public function update(int $id, ProductDto $dto): ?Product
    {
        return $this->repository->update($id, $dto);
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
