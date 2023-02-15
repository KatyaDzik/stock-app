<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll()
    {
        return Customer::all();
    }

    public function invoices($id)
    {
        return $this->getById($id)->invoices;
    }

    public function getById($id)
    {
        $customer = Customer::find($id);
        $customer->author;
        return $customer;
    }
}
