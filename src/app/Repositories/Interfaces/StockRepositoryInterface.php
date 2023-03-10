<?php

namespace App\Repositories\Interfaces;

use App\Dto\StockDto;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StockRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Stock|null
     */
    public function getById(int $id): ?Stock;

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator;

    /**
     * @param StockDto $dto
     * @return Stock
     */
    public function save(StockDto $dto): Stock;

    /**
     * @param int $id
     * @param StockDto $dto
     * @return bool
     */
    public function update(int $id, StockDto $dto): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
