<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LogoutException;
use App\Exceptions\ModelNotCreatedException;
use App\Http\LoginDto;
use App\Repositories\UserRepository;
use App\Services\Interfaces\AuthServiceInterface;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserDto $dto
     * @return array
     */
    public function register(UserDto $dto): array
    {
        try {
            $this->repository->save($dto);
            return ['success' => 'регистрация прошла успешно'];
        } catch (\Exception $exception) {
            throw new ModelNotCreatedException();
        }
    }

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
