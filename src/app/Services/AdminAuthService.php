<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LogoutException;
use App\Services\Interfaces\AdminAuthServiceInterface;

/**
 * Class AdminAuthService
 * @package App\Services
 */
class AdminAuthService implements AdminAuthServiceInterface
{
    /**
     * @param LoginDto $dto
     * @return string[]
     */
    public function login(LoginDto $dto): array
    {
        if (auth('admin')->attempt(['login' => $dto->getLogin(), 'password' => $dto->getPassword()])) {
            return ['success' => 'Успешный вход в систему'];
        } else {
            throw new InvalidCredentialsException();
        }
    }

    /**
     * @return string[]
     */
    public function logout(): array
    {
        try {
            auth('admin')->logout();
            return ['message' => 'Успешный выход'];
        } catch (\Exception $exception) {
            throw new LogoutException();
        }
    }
}
