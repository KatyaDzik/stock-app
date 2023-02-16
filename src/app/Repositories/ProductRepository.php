<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Stock;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getById($id): ?Product
    {
        return Product::find($id);
    }

    public function getProductsByCategory($id): Collection
    {
        return Category::find($id)->products;
    }

    public function getProductsByInvoice($id): Collection
    {
        return Invoice::find($id)->products;
    }

    public function getProductsByStock($id): Collection
    {
        return Stock::find($id)->products;
    }
}
