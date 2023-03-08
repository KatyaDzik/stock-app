<?php

namespace App\Services;

use App\Dto\InvoiceDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use App\Repositories\ReceiptOfProductsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class InvoiceService
 * @package App\Services
 */
class InvoiceService
{
    private InvoiceRepository $repository;

    /**
     * @param InvoiceRepository $repository
     */
    public function __construct(InvoiceRepository $repository)
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
     * @param InvoiceDto $dto
     * @return void
     */
    public function create(InvoiceDto $dto): void
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function read(int $id): Invoice
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param InvoiceDto $dto
     * @return void
     */
    public function update(int $id, InvoiceDto $dto): void
    {
        try {
            if ($dto->getType() === 1 && $dto->getStatus() === 3) {
                $repository = new ReceiptOfProductsRepository();
                $service = new ReceiptOfProductsService($repository);
                $service->createFromInvoice($id);
            }

            $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
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
}
