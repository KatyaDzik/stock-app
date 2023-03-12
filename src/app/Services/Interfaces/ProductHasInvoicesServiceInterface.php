<?php

namespace App\Services\Interfaces;

use App\Dto\ProductHasInvoiceDto;

interface ProductHasInvoicesServiceInterface
{
    /**
     * @param int $id
     * @return string[]
     */
    public function delete(int $id): array;

    /**
     * @param ProductHasInvoiceDto $dto
     * @return array
     * @throws \Exception
     */
    public function create(ProductHasInvoiceDto $dto): array;

    /**
     * @param int $id
     * @param ProductHasInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductHasInvoiceDto $dto): bool;
}
