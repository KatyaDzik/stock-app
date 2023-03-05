<?php

namespace App\Services;

use App\Repositories\ProductHasInvoicesRepository;
use App\Repositories\ReceiptOfProductsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ReceiptOfProductsService
 * @package App\Services
 */
class ReceiptOfProductsService
{
    private ReceiptOfProductsRepository $repository;

    /**
     * @param ReceiptOfProductsRepository $repository
     */
    public function __construct(ReceiptOfProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function createFromInvoice(int $id): bool
    {
        $products = ProductHasInvoicesRepository::getByInvoice($id);
        $data = [];
        foreach ($products as $product) {
            $el = [
                'count' => $product->count,
                'price' => $product->price,
                'nds' => $product->nds,
                'product_id' => $product->product_id
            ];
            $data[] = $el;
        }
        return $this->repository->saveMultiple($data);
    }
}
