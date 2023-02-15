<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getById($id): Product
    {
        return Product::find($id);
    }

    public function getProductsByCategory($id): Collection
    {
        return Product::select('products.*')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.id', '=', $id)
            ->get();
    }
}
