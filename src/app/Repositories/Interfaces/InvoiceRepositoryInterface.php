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
     * @param $id
     * @return Invoice|null
     */
    public function getById($id): ?Invoice;

    /**
     * @param $id
     * @return Invoice|null
     */
    public function getInvoicesByCustomer($id): Collection;

    /**
     * @param $id
     * @return Invoice|null
     */
    public function getInvoicesByProvider($id): Collection;
}
