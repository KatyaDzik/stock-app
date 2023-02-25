<?php
namespace App\Repositories;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::with('role')->get();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User
    {
        return User::findOrFail($id);
    }

    /**
     * @param int $id
     * @param UserDto $data
     * @return User|null
     */
    public function update(int $id, UserDto $data): ?User
    {
        $user = User::findOrFail($id);

        return $user->update([
            'name' => $data->getName(),
            'login' => $data->getLogin(),
            'role_id' => $data->getRole(),
            'password' => Hash::make($data->getPassword())
        ]);
    }

    /**
     * @param UserDto $data
     * @return User|null
     */
    public function save(UserDto $data): ?User
    {
        return User::create([
            'name' => $data->getName(),
            'login' => $data->getLogin(),
            'role_id' => $data->getRole(),
            'password' => Hash::make($data->getPassword())
        ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    /**
     * @param string $login
     * @return User|null
     */
    public function getByLogin(string $login): ?User
    {
        return User::where('login', $login)->firstOrFail();
    }
}
