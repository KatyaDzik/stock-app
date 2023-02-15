<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll()
    {
        return Product::all();
    }

    public function invoices($id)
    {
        return $this->getById($id)->invoices;
    }

    public function getById($id)
    {
        $product = Product::find($id);
        $product->status;
        $product->author;
        return $product;
    }

    public function stocks($id)
    {
        return $this->getById($id)->stocks;
    }
}
