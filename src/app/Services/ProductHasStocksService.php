<?php

namespace App\Services;

use App\Dto\ProductInStockDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Repositories\ProductHasStocksRepository;
use App\Repositories\ReceiptOfProductsRepository;
use App\Services\Interfaces\ProductHasStocksServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductHasStocksService
 * @package App\Services
 */
class ProductHasStocksService implements ProductHasStocksServiceInterface
{
    private ProductHasStocksRepository $repository;

    /**
     * @param ProductHasStocksRepository $repository
     */
    public function __construct(ProductHasStocksRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return bool
     */
    public function update(int $id, ProductInStockDto $dto): bool
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return void
     */
    public function saveReceivedGoods(int $id, ProductInStockDto $dto): void
    {
        DB::transaction(function () use ($id, $dto) {
            $this->create($dto);
            $repository = new ReceiptOfProductsRepository();
            $service = new ReceiptOfProductsService($repository);

            $service->delete($id);
        });
    }

    /**
     * @param ProductInStockDto $dto
     * @return string[]
     */
    public function create(ProductInStockDto $dto): array
    {
        try {
            $this->repository->save($dto);
            return ['success' => 'added'];
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @return string[]
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
