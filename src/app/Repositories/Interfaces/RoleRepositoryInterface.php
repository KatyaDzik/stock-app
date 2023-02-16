<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function getALL(): Collection;

    public function getById($id): ?Role;
}
