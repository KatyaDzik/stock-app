<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Interfaces\CustomerRepositoryInterface;


class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function getById($id): ?Customer
    {
        return Customer::find($id);
    }

    public function getCustomerByInvoice($id): ?Customer
    {
        return Invoice::find($id)->customer;
    }
}
