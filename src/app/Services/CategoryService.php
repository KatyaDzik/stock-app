<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{
    private CategoryRepository $repository;

    /**
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param CategoryDto $data
     * @return array
     */
    public function create(CategoryDto $data): array
    {
        try {
            $category = $this->repository->save($data);
            return ['category' => new CategoryResource($category)];
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }


    /**
     * @param int $id
     * @return array
     */
    public function read(int $id): array
    {
        try {
            $category = $this->repository->getById($id);
            return ['category' => new CategoryResource($category)];
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }


    /**
     * @param int $id
     * @param CategoryDto $data
     * @return array
     */
    public function update(int $id, CategoryDto $data): array
    {
        $category = $this->repository->getById($id);

        $array_for_update = $this->checkFieldForUpdate($category, $data);

        if (!empty($array_for_update)) {
            try {
                $category = $this->repository->update($id, $data);
            } catch (\Exception $e) {
                throw new ModelNotUpdatedException();
            }
        }

        return ['category' => new CategoryResource($category)];
    }

    /**
     * @param Category $category
     * @param CategoryDto $dto
     * @return array
     */
    public function checkFieldForUpdate(Category $category, CategoryDto $dto): array
    {
        $data = [];

        if ($category->name !== $dto->getName()) {
            $data['name'] = $dto->getName();
        }

        if ($category->parent_id !== $dto->getParent()) {
            $data['parent_id'] = $dto->getParent();
        }

        return $data;
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
}
