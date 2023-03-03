<?php

namespace App\Repositories\Interfaces;

use App\Dto\ProductToInvoiceDto;
use App\Models\ProductHasInvoices;

interface ProductHasInvoicesRepositoryInterface
{
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param ProductToInvoiceDto $dto
     * @return null|ProductHasInvoices
     */
    public function save(ProductToInvoiceDto $dto): ?ProductHasInvoices;

    /**
     * @param int $id
     * @param ProductToInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductToInvoiceDto $dto): bool;
}
