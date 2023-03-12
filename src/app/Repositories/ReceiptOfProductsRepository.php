<?php

namespace App\Repositories;

use App\Dto\ReceiptOfProductsDto;
use App\Models\ReceiptOfProducts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ReceiptOfProductsRepository
 * @package App\Repositories
 */
class ReceiptOfProductsRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return ReceiptOfProducts::all();
    }

    /**
     * @param int $id
     * @return ReceiptOfProducts
     */
    public function getByProduct(int $id): ReceiptOfProducts
    {
        return ReceiptOfProducts::where('product_id', $id)->first();
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return ReceiptOfProducts::paginate($count);
    }

    /**
     * @param ReceiptOfProductsDto $dto
     * @return null|ReceiptOfProducts
     */
    public function save(ReceiptOfProductsDto $dto): ?ReceiptOfProducts
    {
        return ReceiptOfProducts::create([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
        ]);
    }

    /**
     * @param int $id
     * @param ReceiptOfProductsDto $dto
     * @return bool
     */
    public function update(int $id, ReceiptOfProductsDto $dto): bool
    {
        $receipt_of_product = ReceiptOfProducts::findOrFail($id);

        return $receipt_of_product->update([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
        ]);
    }


    /**
     * @param array $data
     * @return bool
     */
    public function saveMultiple(array $data): bool
    {
        return ReceiptOfProducts::insert($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = ReceiptOfProducts::findOrFail($id);

        return $product->delete();
    }
}
