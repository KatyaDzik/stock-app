<?php

namespace App\Services\Interfaces;

use App\Dto\UserDto;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function read(int $id): User;

    /**
     * @param int $id
     * @param UserDto $dto
     * @return User
     */
    public function update(int $id, UserDto $dto): User;

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
