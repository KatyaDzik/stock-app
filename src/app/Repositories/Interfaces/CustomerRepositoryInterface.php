<?php

namespace App\Repositories\Interfaces;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Customer|null
     */
    public function getById(int $id): ?Customer;

    /**
     * @param int $id
     * @return Customer|null
     */
    public function getCustomerByInvoice(int $id): ?Customer;
}
