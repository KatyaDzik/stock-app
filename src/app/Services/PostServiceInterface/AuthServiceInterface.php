<?php

namespace App\Services\PostServiceInterface;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Http\JsonResponse;
interface AuthServiceInterface
{
    /**
     * @param UserDto $dto
     * @return User|null
     */
    public function register(UserDto $dto): ?User;

    /**
     * @param LoginDto $dto
     * @return array
     */
    public function login(LoginDto $dto): array;
}
