<?php

namespace App\Services;

use App\Dto\StockDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Stock;
use App\Repositories\StockRepository;
use App\Services\Interfaces\StockServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class StockService
 * @package App\Services
 */
class StockService implements StockServiceInterface
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }

    /**
     * @param StockDto $dto
     * @return Stock
     */
    public function create(StockDto $dto): Stock
    {
        try {
            return $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @param StockDto $dto
     * @return bool
     */
    public function update(int $id, StockDto $dto): bool
    {
        try {
            return $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param int $id
     * @return string[]
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
