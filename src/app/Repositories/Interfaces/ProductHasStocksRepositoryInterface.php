<?php

namespace App\Repositories\Interfaces;

use App\Dto\ProductInStockDto;
use App\Models\ProductHasStocks;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductHasStocksRepositoryInterface
{
    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param ProductInStockDto $dto
     * @return null|ProductHasStocks
     */
    public function save(ProductInStockDto $dto): ?ProductHasStocks;

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return bool
     */
    public function update(int $id, ProductInStockDto $dto): bool;
}
