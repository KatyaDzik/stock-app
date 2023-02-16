<?php

namespace App\Repositories\Interfaces;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

interface StockRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection;

    /**
     * @param $id
     * @return Stock|null
     */
    public function getById($id): ?Stock;
}
