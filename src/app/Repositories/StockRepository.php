<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;

class StockRepository implements StockRepositoryInterface
{
    public function getALL()
    {
        return Stock::all();
    }

    public function getProducts($id)
    {
        return $this->getById($id)->products;
    }

    public function getById($id)
    {
        return Stock::find($id);
    }
}
