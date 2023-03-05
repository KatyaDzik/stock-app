<?php

namespace App\Services\Interfaces;

use App\Dto\ProductToInvoiceDto;

interface ProductHasInvoicesServiceInterface
{
    /**
     * @param int $id
     * @return string[]
     */
    public function delete(int $id): array;

    /**
     * @param ProductToInvoiceDto $dto
     * @return array
     * @throws \Exception
     */
    public function create(ProductToInvoiceDto $dto): array;

    /**
     * @param int $id
     * @param ProductToInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductToInvoiceDto $dto): bool;
}
