<?php

namespace App\Services\Interfaces;

use App\Dto\ProductInStockDto;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductHasStocksServiceInterface
{
    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator;

    /**
     * @param int $id
     * @return string[]
     */
    public function delete(int $id): array;

    /**
     * @param ProductInStockDto $dto
     * @return string[]
     */
    public function create(ProductInStockDto $dto): array;

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return bool
     */
    public function update(int $id, ProductInStockDto $dto): bool;
}
