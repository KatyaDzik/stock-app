<?php

namespace App\Repositories\Interfaces;

use App\Dto\ProductHasInvoiceDto;
use App\Models\ProductHasInvoices;

interface ProductHasInvoicesRepositoryInterface
{
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param ProductHasInvoiceDto $dto
     * @return null|ProductHasInvoices
     */
    public function save(ProductHasInvoiceDto $dto): ?ProductHasInvoices;

    /**
     * @param int $id
     * @param ProductHasInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductHasInvoiceDto $dto): bool;
}
