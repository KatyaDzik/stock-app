<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
     * @param $id
     * @return Stock|null
     */
    public function getById($id): ?Stock
    {
        return Stock::find($id);
    }
}
