<?php

namespace App\Services;

use App\Dto\ProductToInvoiceDto;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Repositories\ProductHasInvoicesRepository;

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

    /**
     * @param ProductToInvoiceDto $dto
     * @return array
     * @throws \Exception
     */
    public function create(ProductToInvoiceDto $dto): array
    {
        try {
            $this->repository->save($dto);
            return ['success' => 'added'];
        } catch (\Exception $e) {
            throw new \Exception();
        }
    }

    /**
     * @param int $id
     * @param ProductToInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductToInvoiceDto $dto): bool
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }
}
