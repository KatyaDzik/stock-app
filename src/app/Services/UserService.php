<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PostServiceInterface\UserServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;


class UserService implements UserServiceInterface
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function read(int $id): ?User
    {
        $user = $this->repository->getById($id);

        return $user;
    }


    /**
     * @param array $data
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function update(int $id, UserDto $dto): ?User
    {
        $user = $this->repository->update($id, $dto);

        return $user;
    }


    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);

        return $result;
    }


    /**
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse
    {
        $user = $this->repository->getByName($data['name']);

        if (Hash::check($data['password'], $user->password)) {
            $success['jwt'] = $user->createToken('token')->plainTextToken;
            return response()->json(['jwt' => $success['jwt']]);
        } else {
            return response()->json(['errors' => 'Неправильный логин или пароль'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
