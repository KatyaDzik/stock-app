<?php

namespace App\Services\PostServiceInterface;

use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function read(int $id): ?User;


    /**
     * @param array $data
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function update(int $id, UserDto $dto): ?User;

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool;


    /**
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse;
}
