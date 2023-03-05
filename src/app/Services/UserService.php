<?php

namespace App\Services;

use App\Dto\PermissionsToUpdateDto;
use App\Dto\UserDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;


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
     * @return User
     */
    public function read(int $id): User
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param UserDto $dto
     * @return User
     */
    public function update(int $id, UserDto $dto): User
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
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

    /**
     * @param int $id
     * @param PermissionsToUpdateDto $dto
     * @return User
     */
    public function updatePermissions(int $id, PermissionsToUpdateDto $dto): User
    {
        try {
            return $this->repository->updatePermissions($id, $dto->getPermissions());
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param UserDto $dto
     * @return array
     */
    public function create(UserDto $dto): array
    {
        try {
            $this->repository->save($dto);
            return ['success' => 'регистрация прошла успешно'];
        } catch (\Exception $exception) {
            throw new ModelNotCreatedException();
        }
    }
}
