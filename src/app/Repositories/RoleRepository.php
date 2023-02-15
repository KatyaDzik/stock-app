<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getALL()
    {
        return Role::all();
    }

    public function getUsers($id)
    {
        return $this->getById($id)->users;
    }

    public function getById($id)
    {
        return Role::find($id);
    }

}
