<?php

namespace App\Services\Interfaces;

use App\Dto\UserDto;
use App\Http\LoginDto;

interface AuthServiceInterface
{
    /**
     * @param UserDto $dto
     * @return array
     */
    public function register(UserDto $dto): array;

    /**
     * @param LoginDto $dto
     * @return array
     */
    public function login(LoginDto $dto): array;

    /**
     * @return array
     */
    public function logout(): array;
}
