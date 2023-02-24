<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StockRepository
 * @package App\Repositories
 */
class StockRepository implements StockRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection
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
}
