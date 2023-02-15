<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Interfaces\CustomerRepositoryInterface;


class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function getById($id): Customer
    {
        return ustomer::find($id);
    }

    public function getCustomerByInvoice($id): Customer
    {
        return Customer::select('customers.*')
            ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
            ->where('invoices.id', '=', $id)
            ->first();
    }
}
