<?php

namespace App\Repositories\Interfaces;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    public function getAll(): Collection;

    public function getById($id): ?Invoice;

    public function getInvoicesByCustomer($id): ?Invoice;

    public function getInvoicesByProvider($id): ?Invoice;
}
