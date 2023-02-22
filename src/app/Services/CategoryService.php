<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\PostServiceInterface\CategoryServiceInterface;

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
     * @return Category|null
     */
    public function create(CategoryDto $data): ?Category
    {
        return $this->repository->save($data);
    }


    /**
     * @param int $id
     * @return Category|null
     */
    public function read(int $id): ?Category
    {
        return $this->repository->getById($id);
    }


    /**
     * @param int $id
     * @param CategoryDto $data
     * @return Category|null
     */
    public function update(int $id, CategoryDto $data): ?Category
    {
        $category = $this->repository->getById($id);

        $array_for_update = $this->checkFieldForUpdate($category, $data);

        if (!empty($array_for_update)) {
            $category = $this->repository->update($id, $array_for_update);
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
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
