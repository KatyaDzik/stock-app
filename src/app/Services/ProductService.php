<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use App\Services\Interfaces\ProductServiceInterface;

/**
 * Class ProductService
 * @package App\Services
 */
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
     * @return array
     */
    public function create(ProductDto $dto): array
    {
        try {
            $product = $this->repository->save($dto);
            return ['product' => new ProductResource($product)];
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }


    /**
     * @param int $id
     * @return array
     */
    public function read(int $id): array
    {
        try {
            $product = $this->repository->getById($id);
            return ['product' => new ProductResource($product)];
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }


    /**
     * @param int $id
     * @param ProductDto $dto
     * @return array
     */
    public function update(int $id, ProductDto $dto): array
    {
        try {
            $product = $this->repository->update($id, $dto);
            return ['product' => new ProductResource($product)];
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }


    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function delete(int $id): array
    {
        try {
            $this->repository->delete($id);
            return ['success' => 'deleted'];
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }
}
