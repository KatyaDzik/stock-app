<?php

namespace App\Repositories;

use App\Dto\StockDto;
use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class StockRepository
 * @package App\Repositories
 */
class StockRepository implements StockRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Stock::all();
    }

    /**
     * @param int $id
     * @return Stock|null
     */
    public function getById(int $id): ?Stock
    {
        return Stock::find($id);
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return Stock::paginate($count);
    }

    /**
     * @param StockDto $dto
     * @return Stock
     */
    public function save(StockDto $dto): Stock
    {
        return Stock::create([
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
        ]);
    }

    /**
     * @param int $id
     * @param StockDto $dto
     * @return bool
     */
    public function update(int $id, StockDto $dto): bool
    {
        $stock = Stock::findOrFail($id);

        return $stock->update([
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
        ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stock = Stock::findOrFail($id);

        return $stock->delete();
    }
}
