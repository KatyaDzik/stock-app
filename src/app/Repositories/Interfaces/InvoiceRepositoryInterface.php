<?php

namespace App\Repositories\Interfaces;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;


    /**
     * @param int $id
     * @return Invoice|null
     */
    public function getById(int $id): ?Invoice;

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByCustomer(int $id): Collection;

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByProvider(int $id): Collection;
}
