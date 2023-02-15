<?php

namespace App\Repositories\Interfaces;

interface ProviderRepositoryInterface
{
    public function getALL();

    public function getById($id);

    public function invoices($id);
}
