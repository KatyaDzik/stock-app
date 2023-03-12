<?php

namespace App\Services\Interfaces;

use App\Dto\ProductInStockDto;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductHasStocksServiceInterface
{
    /**
     * @param int $id
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $id,int $count): LengthAwarePaginator;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param ProductInStockDto $dto
     * @return void
     */
    public function create(ProductInStockDto $dto): void;

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return void
     */
    public function update(int $id, ProductInStockDto $dto): void;
}
