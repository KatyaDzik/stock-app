<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Dto\ProviderDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\ProviderRepository;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Validation\ProductValidationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {
            $provider_repository = new ProviderRepository();
            $provider = $provider_repository->getByName($data['provider']);

            if (!$provider) {
                $provider = $provider_repository->save(new ProviderDto($data['provider'], auth()->user()->id));
            }

            $validator = new ProductValidationService();
            $validator->isExistProductNameAtProvider($data['name'], $provider->id);

            try {
                $this->repository->save(new ProductDto($data['name'], $data['category_id'], $provider->id,
                    auth()->user()->id));
            } catch (\Exception $exception) {
                throw new ModelNotCreatedException();
            }
        });
    }

    /**
     * @param int $id
     * @return Product
     */
    public function read(int $id): Product
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $product = $this->repository->getById($id);
        $validator = new ProductValidationService();
        $validator->isExistProductNameAtProvider($data['name'], $product->provider_id);

        try {
            $this->repository->update($id,
                new ProductDto($data['name'], $data['category_id'], $product->provider_id, $product->author_id));
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $this->repository->delete($id);
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }
}
