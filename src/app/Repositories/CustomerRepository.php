<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
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
     * @param int $id
     * @return Customer|null
     */
    public function getById(int $id): ?Customer
    {
        return Customer::find($id);
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function getCustomerByInvoice(int $id): ?Customer
    {
        return Customer::whereHas('invoices', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }
}
