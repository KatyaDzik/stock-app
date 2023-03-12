<?php

namespace App\Services;

use App\Dto\ProviderDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProviderService
{
    private ProviderRepository $repository;

    /**
     * @param ProviderRepository $repository
     */
    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ProviderDto $dto
     * @return void
     */
    public function create(ProviderDto $dto): void
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @return Provider
     */
    public function read(int $id): Provider
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param ProviderDto $dto
     * @return void
     */
    public function update(int $id, ProviderDto $dto): void
    {
        try {
            $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $this->repository->delete($id);
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }
}
