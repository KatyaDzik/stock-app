<?php

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getProducts($id);

    public function getMovement($id);

    public function getCustomer($id);

    public function getProvider($id);

}
