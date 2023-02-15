<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getALL();

    public function getById($id);
}
