<?php

namespace App\Repositories\Interfaces;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;


interface CustomerRepositoryInterface
{
    public function getAll(): Collection;

    public function getById($id): ?Customer;

    public function getCustomerByInvoice($id): ?Customer;
}
