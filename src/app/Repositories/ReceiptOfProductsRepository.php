<?php

namespace App\Repositories;

use App\Dto\ReceiptOfProductsDto;
use App\Models\ReceiptOfProducts;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ReceiptOfProductsRepository
 * @package App\Repositories
 */
class ReceiptOfProductsRepository
{
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
     * @param array $data
     * @return bool
     */
    public function saveMultiple(array $data): bool
    {
        return ReceiptOfProducts::insert($data);
    }
}
