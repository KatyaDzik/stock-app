<?php

namespace App\Repositories;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInteface;
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
    public function update(array $data, int $id): ?User
    {
        $user = User::find($id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data)->save();

        return $user;
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function save(UserDto $data): ?User
    {
        $user = new User();
        $user->name = $data->getName();
        $user->role_id = $data->getRole();
        $user->password = Hash::make($data->getPassword());
        $user->save();

        return $user;
    }

    /**
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function delete(int $id): ?User
    {
        $user = User::find($id);

        if (!$user) {
            throw new \Exception('Unable to delete post data');
        }

        $user->delete();

        return $user;
    }


    /**
     * @param string $name
     * @return User|null
     */
    public function getByName(string $name): ?User
    {
        $user = User::where('name', $name)->first();
        return $user;
    }

}
