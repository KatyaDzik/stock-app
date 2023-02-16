<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Provider;
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
     * @param $id
     * @return Invoice|null
     */
    public function getById($id): ?Invoice
    {
        return Invoice::find($id);
    }

    /**
     * @param $id
     * @return Invoice|null
     */
    public function getInvoicesByCustomer($id): Collection
    {
        return Invoice::where('customer_id', $id)->get();
    }

    /**
     * @param $id
     * @return Invoice|null
     */
    public function getInvoicesByProvider($id): Collection
    {
        return Invoice::where('provider_id', $id)->get();
    }
}
