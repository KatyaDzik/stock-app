<?php

namespace App\Repositories\Interfaces;

interface CategoryIRepositoryInterface
{
    public function all();

    public function getById($id);
}
