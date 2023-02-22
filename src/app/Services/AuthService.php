<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PostServiceInterface\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private $repository;

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
        $result = $this->repository->save($dto);

        return $result;
    }

    /**
     * @param LoginDto $dto
     * @return JsonResponse
     */
    public function login(LoginDto $dto): JsonResponse
    {
        $user = $this->repository->getByLogin($dto->getLogin());

        if (Hash::check($dto->getPassword(), $user->password)) {
            $success['jwt'] = $user->createToken('token')->plainTextToken;
            return response()->json(['jwt' => $success['jwt']]);
        } else {
            return response()->json(['errors' => 'Неправильный логин или пароль'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
