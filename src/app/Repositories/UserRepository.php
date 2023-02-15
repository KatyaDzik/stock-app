<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getALL(): Collection
    {
        return User::all();
    }

    public function getById($id): User
    {
        return User::find($id);
    }

}
