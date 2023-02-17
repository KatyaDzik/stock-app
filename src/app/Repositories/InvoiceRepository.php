<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Invoice::all();
    }

    /**
     * @param int $id
     * @return Invoice|null
     */
    public function getById(int $id): ?Invoice
    {
        return Invoice::find($id);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByCustomer(int $id): Collection
    {
        return Invoice::where('customer_id', $id)->get();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByProvider(int $id): Collection
    {
        return Invoice::where('provider_id', $id)->get();
    }
}
