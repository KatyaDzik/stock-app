<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getAll(): Collection
    {
        return Invoice::all();
    }

    public function getById($id): Invoice
    {
        return Invoice::find($id);
    }

    public function getInvoicesByCustomer($id): Collection
    {
        return Invoice::select('invoices.*')
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->where('customers.id', '=', $id)
            ->get();
    }

    public function getInvoicesByProvider($id): Collection
    {
        return Invoice::select('invoices.*')
            ->join('providers', 'invoices.provider_id', '=', 'provider.id')
            ->where('providers.id', '=', $id)
            ->get();
    }
}
