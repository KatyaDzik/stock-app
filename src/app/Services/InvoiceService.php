<?php

namespace App\Services;

use App\Dto\InvoiceDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
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
     * @param $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate($count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }

    /**
     * @param InvoiceDto $dto
     * @return Invoice
     */
    public function create(InvoiceDto $dto): Invoice
    {
        try {
            return $this->repository->save($dto);
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
     * @return bool
     */
    public function update(int $id, InvoiceDto $dto): bool
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
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
