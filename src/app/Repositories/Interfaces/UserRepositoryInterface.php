<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection;


    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;
}
