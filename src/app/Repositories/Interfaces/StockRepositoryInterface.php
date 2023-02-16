<?php

namespace App\Repositories\Interfaces;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

interface StockRepositoryInterface
{
    public function getALL(): Collection;

    public function getById($id): ?Stock;
}
