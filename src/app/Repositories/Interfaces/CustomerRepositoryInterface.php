<?php

namespace App\Repositories\Interfaces;

use App\Models\Invoice;

interface CustomerRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function invoices($id);

}
