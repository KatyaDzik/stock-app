<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PostServiceInterface\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

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
    public function register(UserDto $dto): ?User
    {
        return $this->repository->save($dto);
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
            return ['errors' => 'Неправильный логин или пароль'];
        }
    }
}
