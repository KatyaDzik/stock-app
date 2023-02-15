<?php

namespace App\Repositories\Interfaces;

interface StockRepositoryInterface
{
    public function getALL();

    public function getById($id);

    public function getProducts($id);
}
