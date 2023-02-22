<?php

namespace App\Repositories;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

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
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return User|null
     */
    public function update(int $id, UserDto $data): ?User
    {
        $user = User::find($id);

        $user->fill([
            'name' => $data->getName(),
            'login' => $data->getLogin(),
            'role_id' => $data->getRole(),
            'password' => Hash::make($data->getPassword())
        ])->update();

        return $user;
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function save(UserDto $data): ?User
    {
        $user = new User();
        $user->fill([
            'name' => $data->getName(),
            'login' => $data->getLogin(),
            'role_id' => $data->getRole(),
            'password' => Hash::make($data->getPassword())
        ])->save();

        return $user;
    }

    /**
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $user = User::where('id', $id)->delete();;

        return $user;
    }


    /**
     * @param string $login
     * @return User|null
     */
    public function getByLogin(string $login): ?User
    {
        $user = User::where('login', $login)->first();

        return $user;
    }
}
