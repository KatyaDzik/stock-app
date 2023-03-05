<?php

namespace App\Services\Interfaces;

use App\Dto\StockDto;
use App\Models\Stock;
use Illuminate\Pagination\LengthAwarePaginator;

interface StockServiceInterface
{
    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator;

    /**
     * @param StockDto $dto
     * @return Stock
     */
    public function create(StockDto $dto): Stock;

    /**
     * @param int $id
     * @param StockDto $dto
     * @return bool
     */
    public function update(int $id, StockDto $dto): bool;

    /**
     * @param int $id
     * @return string[]
     */
    public function delete(int $id): array;
}
