<?php

namespace App\Repositories;

use App\Dto\ProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 * @package App\Repositories
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
        return Product::findOrFail($id);
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
        $product = Product::findOrFail($id);

        return $product->update([
            'name' => $dto->getName(),
            'category_id' => $dto->getCategory()
        ]);
    }


    /**
     * @param ProductDto $dto
     * @return Product|null
     */
    public function save(ProductDto $dto): ?Product
    {
        return Product::create([
            'name' => $dto->getName(),
            'category_id' => $dto->getCategory(),
            'author_id' => $dto->getAuthor()
        ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
