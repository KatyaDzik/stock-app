<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getAll()
    {
        return Invoice::all();
    }

    public function getProducts($id)
    {
        return $this->getById($id)->products;
    }

    public function getById($id)
    {
        $invoice = Invoice::find($id);
        $invoice->movement;
        $invoice->customer;
        $invoice->provider;
        return $invoice;
    }

    public function getMovement($id)
    {
        return $this->getById($id)->movement;
    }

    public function getCustomer($id)
    {
        return $this->getById($id)->customer;
    }

    public function getProvider($id)
    {
        return $this->getById($id)->provider;
    }
}
