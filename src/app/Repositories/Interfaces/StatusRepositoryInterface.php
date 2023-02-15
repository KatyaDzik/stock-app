<?php

namespace App\Repositories\Interfaces;

interface StatusRepositoryInterface
{
    public function getALL();

    public function getById($id);

    public function getMovements($id);
}
