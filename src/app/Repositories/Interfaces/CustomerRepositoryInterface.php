<?php

namespace App\Repositories\Interfaces;

use App\Models\Invoice;

interface CustomerRepositoryInterface
{
    public function all();

    public function getById($id);

}
