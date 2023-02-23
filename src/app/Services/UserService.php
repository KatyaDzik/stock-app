<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;


/**
 * Class UserService
 * @package App\Services
 */
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
     * @return array
     */
    public function read(int $id): array
    {
        try {
            $user = $this->repository->getById($id);
            return ['user' => new UserResource($user)];
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }


    /**
     * @param int $id
     * @param UserDto $dto
     * @return array
     */
    public function update(int $id, UserDto $dto): array
    {
        try {
            $user = $this->repository->update($id, $dto);
            return ['user' => new UserResource($user)];
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }


    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        try {
            $this->repository->delete($id);
            return ['success' => 'deleted'];
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }
}
