<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Customer::all();
    }

    /**
     * @param $id
     * @return Customer|null
     */
    public function getById($id): ?Customer
    {
        return Customer::find($id);
    }

    /**
     * @param $id
     * @return Customer|null
     */
    public function getCustomerByInvoice($id): Customer
    {
        return Customer::whereHas('invoices', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }
}
