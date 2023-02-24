<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
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
     * @return Category
     */
    public function create(CategoryDto $data): Category
    {
        try {
            return $this->repository->save($data);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @return Category
     */
    public function read(int $id): Category
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param CategoryDto $data
     * @return Category
     */
    public function update(int $id, CategoryDto $data): Category
    {
        $category = $this->repository->getById($id);

        $array_for_update = $this->checkFieldForUpdate($category, $data);

        if (!empty($array_for_update)) {
            try {
                $category = $this->repository->update($id, $array_for_update);
            } catch (\Exception $e) {
                throw new ModelNotUpdatedException();
            }
        }

        return $category;
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
