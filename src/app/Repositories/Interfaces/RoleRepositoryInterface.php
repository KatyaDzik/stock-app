<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection;

    /**
     * @param $id
     * @return Role|null
     */
    public function getById($id): ?Role;
}
