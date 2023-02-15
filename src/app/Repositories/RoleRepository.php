<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    public function getALL(): Collection
    {
        return Role::all();
    }

    public function getById($id): Role
    {
        return Role::find($id);
    }

}
