<?php

namespace App\Services;

use App\Dto\ReceiptOfProductsDto;
use App\Exceptions\ModelNotDeletedException;
use App\Repositories\ProductHasInvoicesRepository;
use App\Repositories\ReceiptOfProductsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
     * @return void
     */
    public function createFromInvoice(int $id): void
    {
//        DB::transaction(function () use ($id) {
//            try {
//                $repository = new ProductHasInvoicesRepository();
//                $products_from_invoice = $repository->getByInvoice($id);
//                $receipt_of_products = $this->repository->getAll();
//                foreach ($products_from_invoice as $product) {
//
//                    if ($receipt_of_products->containsStrict('product_id', $product->product_id)) {
//                        $receipt_of_product = $this->repository->getByProduct($product->product_id);
//                        $this->repository->update($receipt_of_product->id,
//                            new ReceiptOfProductsDto($receipt_of_product->count + $product->count,
//                                $receipt_of_product->price,
//                                $receipt_of_product->nds, $receipt_of_product->product_id));
//                    } else {
//                        $this->repository->save(new ReceiptOfProductsDto($product->count, $product->price,
//                            $product->nds,
//                            $product->product_id));
//                    }
//                }
//            } catch (\Exception $e) {
//                throw new \Exception($e->getMessage());
//            }
//        });
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function delete(int $id): array
    {
        try {
            $this->repository->delete($id);
            return ['success' => 'deleted'];
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }
}
