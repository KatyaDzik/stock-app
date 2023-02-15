<?php

namespace App\Repositories\Interfaces;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;

    public function getById($id): Product;

    public function getProductsByCategory($id): Collection;

    //public function getProductsByInvoice($id): Collection;

    //public function getProductsByStock($id): Collection;
}
