<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::all();
    }

    public function getById($id)
    {
        return Customer::find($id);
    }
}
