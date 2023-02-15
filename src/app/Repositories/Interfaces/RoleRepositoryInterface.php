<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getALL();

    public function getById($id);

    public function getUsers($id);
}
