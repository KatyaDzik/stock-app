<?php

namespace App\Services\Interfaces;

use App\Http\LoginDto;

interface AdminAuthServiceInterface
{
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
