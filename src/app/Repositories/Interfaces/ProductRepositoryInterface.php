<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function invoices($id);

    public function stocks($id);
}
