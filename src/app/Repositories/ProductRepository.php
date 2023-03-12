<?php

namespace App\Repositories;

use App\Dto\ProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return Product::with('provider')->with('category')->with('author')->paginate($count);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
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
     * @param string $name
     * @param int $provider_id
     * @return null|Product
     */
    public function getByNameAndProvider(string $name, int $provider_id): ?Product
    {
        return Product::where('name', $name)->where('provider_id', $provider_id)->first();
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
    public function getProductsByProvider(int $id): Collection
    {
        return Product::whereHas('invoices', function ($query) use ($id) {
            $query->with('invoice')->where('provider_id', $id);
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
     * @return bool
     */
    public function update(int $id, ProductDto $dto): bool
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
            'provider_id' => $dto->getProvider(),
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
