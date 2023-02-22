<?php

namespace App\Repositories;

use App\Dto\ProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
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
     * @param int $id
     * @param ProductDto $dto
     * @return Product|null
     */
    public function update(int $id, ProductDto $dto): ?Product
    {
        $product = Product::find($id);
        $product->fill([
            'name' => $dto->getName(),
            'category_id' => $dto->getCategory(),
        ])->update();

        return $product;
    }


    /**
     * @param ProductDto $dto
     * @return Product|null
     */
    public function save(ProductDto $dto): ?Product
    {
        $product = new Product();
        $product->fill([
            'name' => $dto->getName(),
            'category_id' => $dto->getCategory(),
            'author_id' => $dto->getAuthor()
        ])->save();

        return $product;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Product::where('id', $id)->delete();
    }
}
