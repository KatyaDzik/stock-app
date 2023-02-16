<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Provider;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getAll(): Collection
    {
        return Invoice::all();
    }

    public function getById($id): ?Invoice
    {
        return Invoice::find($id);
    }

    public function getInvoicesByCustomer($id): ?Invoice
    {
        return Customer::find($id)->invoice;
    }

    public function getInvoicesByProvider($id): ?Invoice
    {
        return Provider::find($id)->invoice;
    }
}
