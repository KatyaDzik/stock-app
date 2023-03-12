<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Dto\ProductHasInvoiceDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\ProductHasInvoices;
use App\Repositories\ProductHasInvoicesRepository;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductHasInvoicesService
 * @package App\Services
 */
class ProductHasInvoicesService
{
    private ProductHasInvoicesRepository $repository;

    /**
     * @param ProductHasInvoicesRepository $repository
     */
    public function __construct(ProductHasInvoicesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $this->repository->delete($id);
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }

    public function saveIncomingProducts(ProductHasInvoiceDto $dto)
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    public function getAllByInvoicePaginate(int $id, int $count): LengthAwarePaginator
    {
        return $this->repository->getByInvoicePaginate($id, $count);
    }
}
