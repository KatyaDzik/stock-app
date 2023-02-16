<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection
    {
        return User::all();
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getById($id): ?User
    {
        return User::find($id);
    }

}
