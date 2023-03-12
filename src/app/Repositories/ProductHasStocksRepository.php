<?php

namespace App\Repositories;

use App\Dto\ProductInStockDto;
use App\Models\ProductHasStocks;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductHasStocksRepository
 * @package App\Repositories
 */
class ProductHasStocksRepository
{
    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $id, int $count): LengthAwarePaginator
    {
        return ProductHasStocks::where('stock_id', $id)->paginate($count);
    }

    /**
     * @param int $stock_id
     * @param int $product_id
     * @return null|ProductHasStocks
     */
    public function getByStockAndProduct(int $stock_id, int $product_id): ?ProductHasStocks
    {
        return ProductHasStocks::where('stock_id', $stock_id)->where('product_id', $product_id)->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product_has_stock = ProductHasStocks::findOrFail($id);

        return $product_has_stock->delete();
    }

    /**
     * @param ProductInStockDto $dto
     * @return null|ProductHasStocks
     */
    public function save(ProductInStockDto $dto): ?ProductHasStocks
    {
        return ProductHasStocks::create([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
            'stock_id' => $dto->getStock()
        ]);
    }

    /**
     * @param int $id
     * @param ProductInStockDto $dto
     * @return bool
     */
    public function update(int $id, ProductInStockDto $dto): bool
    {
        $product_has_stock = ProductHasStocks::findOrFail($id);

        return $product_has_stock->update([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
            'stock_id' => $dto->getStock()
        ]);
    }
}
