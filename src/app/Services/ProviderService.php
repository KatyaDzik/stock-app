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
     * @return Provider
     */
    public function create(ProviderDto $dto): Provider
    {
        try {
            return $this->repository->save($dto);
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
     * @return Provider
     */
    public function update(int $id, ProviderDto $dto): Provider
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }
}
