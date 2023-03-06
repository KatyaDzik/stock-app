<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LogoutException;
use App\Http\LoginDto;
use App\Repositories\UserRepository;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
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
     * @param LoginDto $dto
     * @return array
     */
    public function loginByToken(LoginDto $dto): array
    {
        $user = $this->repository->getByLogin($dto->getLogin());

        if (Hash::check($dto->getPassword(), $user->password)) {
            return ['jwt' => $user->createToken('token')->plainTextToken];
        } else {
            throw new InvalidCredentialsException();
        }
    }

    /**
     * @return string[]
     */
    public function deleteToken(): array
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            return ['message' => 'Успешный выход'];
        } catch (\Exception $exception) {
            throw new LogoutException();
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
