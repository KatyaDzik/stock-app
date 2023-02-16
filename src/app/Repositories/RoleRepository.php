<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection
    {
        return Role::all();
    }

    /**
     * @param $id
     * @return Role|null
     */
    public function getById($id): ?Role
    {
        return Role::find($id);
    }

}
