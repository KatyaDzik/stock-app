<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Role::all();
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public function getById(int $id): ?Role
    {
        return Role::find($id);
    }
}
