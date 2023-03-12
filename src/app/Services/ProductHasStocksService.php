<?php

namespace App\Services;

use App\Dto\ProductInStockDto;
use App\Dto\ReceiptOfProductsDto;
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
    public function getAllPaginate(int $id, int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate( $id, $count);
    }

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return void
     */
    public function saveReceivedGoods(int $id, ProductInStockDto $dto): void
    {
        DB::transaction(function () use ($id, $dto) {
            $product_has_stock = $this->repository->getByStockAndProduct($id, $dto->getProduct());

            if ($product_has_stock) {
                $this->repository->update($product_has_stock->id,
                    new ProductInStockDto($product_has_stock->count + $dto->getCount(), $product_has_stock->price,
                        $product_has_stock->nds, $product_has_stock->product_id, $product_has_stock->stock_id));
            } else {
                $this->repository->save($dto);
            }

            $receipt_of_product_repository = new ReceiptOfProductsRepository();
            $receipt_of_product = $receipt_of_product_repository->getByProduct($dto->getProduct());

            if ($receipt_of_product->count - $dto->getCount() === 0) {
                $receipt_of_product_repository->delete($receipt_of_product->id);
            } else {
                $receipt_of_product_repository->update($receipt_of_product->id,
                    new ReceiptOfProductsDto($receipt_of_product->count - $dto->getCount(), $receipt_of_product->price,
                        $receipt_of_product->nds, $receipt_of_product->product_id));
            }
        });
    }

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return void
     */
    public function update(int $id, ProductInStockDto $dto): void
    {
        try {
            $this->repository->update($id, $dto);
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
     * @param ProductInStockDto $dto
     * @return void
     */
    public function create(ProductInStockDto $dto): void
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }
}
