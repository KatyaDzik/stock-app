<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LogoutException;
use App\Http\LoginDto;
use App\Services\Interfaces\AuthServiceInterface;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    /**
     * @param LoginDto $dto
     * @return array
     */
    public function login(LoginDto $dto): array
    {
        if (auth('web')->attempt(['login' => $dto->getLogin(), 'password' => $dto->getPassword()])) {
            return ['success' => 'Успешный вход в систему'];
        } else {
            throw new InvalidCredentialsException();
        }
    }

    /**
     * @return array
     */
    public function logout(): array
    {
        try {
            auth('web')->logout();
            return ['message' => 'Успешный выход'];
        } catch (\Exception $exception) {
            throw new LogoutException();
        }
    }
}
