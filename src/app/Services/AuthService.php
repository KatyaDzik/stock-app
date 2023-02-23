<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LogoutException;
use App\Exceptions\ModelNotCreatedException;
use App\Models\User;
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
     * @param UserDto $dto
     * @return User|null
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
        $user = $this->repository->getByLogin($dto->getLogin());

        if (Hash::check($dto->getPassword(), $user->password)) {
            return ['jwt' => $user->createToken('token')->plainTextToken];
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
            auth()->user()->currentAccessToken()->delete();
            return ['message' => 'Успешный выход'];
        } catch (\Exception $exception) {
            throw new LogoutException();
        }
    }
}
