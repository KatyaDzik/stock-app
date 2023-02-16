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

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * @param $id
     * @return Product|null
     */
    public function getById($id): ?Product
    {
        return Product::find($id);
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByCategory($id): Collection
    {
        return Category::find($id)->products;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByInvoice($id): Collection
    {
        return Invoice::find($id)->products;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByStock($id): Collection
    {
        return Stock::find($id)->products;
    }
}
