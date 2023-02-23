<?php

namespace App\Services\Interfaces;

use App\Dto\UserDto;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function read(int $id): array;


    /**
     * @param int $id
     * @param UserDto $dto
     * @return array
     */
    public function update(int $id, UserDto $dto): array;

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
