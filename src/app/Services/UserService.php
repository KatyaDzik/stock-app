<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PostServiceInterface\UserServiceInterface;


class UserService implements UserServiceInterface
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
     * @param int $id
     * @return User|null
     */
    public function read(int $id): ?User
    {
        return $this->repository->getById($id);
    }


    /**
     * @param int $id
     * @param UserDto $dto
     * @return User|null
     */
    public function update(int $id, UserDto $dto): ?User
    {
        return $this->repository->update($id, $dto);
    }


    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
