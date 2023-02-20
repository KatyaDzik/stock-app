<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Stock;
use App\Repositories\Interfaces\PostRepositoryInteface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class ProductRepository implements ProductRepositoryInterface, PostRepositoryInteface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByCategory(int $id): Collection
    {
        return Product::where('category_id', $id)->get();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByInvoice(int $id): Collection
    {
        return Product::whereHas('invoices', function ($query) use ($id) {
            $query->where('invoice_id', '=', $id);
        })->get();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByStock(int $id): Collection
    {
        return Product::whereHas('stocks', function (Builder $query) use ($id) {
            $query->where('stock_id', '=', $id);
        })->get();
    }


    /**
     * @param array $data
     * @param int $id
     * @return Product|null
     */
    public function update(array $data, int $id): ?Product
    {
        $product = Product::find($id);
        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * @param array $data
     * @return Product|null
     */
    public function save(array $data): ?Product
    {
        $product = new Product();
        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * @param int $id
     * @return Product|null
     * @throws \Exception
     */
    public function delete(int $id): ?Product
    {
        $product = Product::find($id);

        if (!$product) {
            throw new \Exception('Unable to delete post data');
        }

        $product->delete();

        return $product;
    }
}
