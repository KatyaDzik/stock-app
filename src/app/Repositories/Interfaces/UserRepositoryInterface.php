<?php

namespace App\Repositories\Interfaces;

use App\Dto\UserDto;
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


    /**
     * @param array $data
     * @param int $id
     * @return User|null
     */
    public function update(int $id, UserDto $data): ?User;


    /**
     * @param array $data
     * @return User|null
     */
    public function save(UserDto $data): ?User;


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;


    /**
     * @param string $login
     * @return User|null
     */
    public function getByLogin(string $login): ?User;
}
