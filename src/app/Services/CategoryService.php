<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\PostServiceInterface\CategoryServiceInterface;
use App\Services\PostServiceInterface\PostServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    private $repository;

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
        $result = $this->repository->save($data);

        return $result;
    }


    /**
     * @param int $id
     * @return Category|null
     */
    public function read(int $id): ?Category
    {
        $category = $this->repository->getById($id);

        return $category;
    }


    /**
     * @param int $id
     * @param CategoryDto $data
     * @return Category|null
     */
    public function update(int $id, CategoryDto $data): ?Category
    {
        $category = $this->repository->getById($id);

        $array_for_update = $this->checkFieldforUpdate($category, $data);

        if (!empty($array_for_update)) {
            $category = $this->repository->update($id, $array_for_update);
        }

        return $category;
    }

    public function checkFieldforUpdate(Category $category, CategoryDto $dto)
    {
        $data = [];

        if ($category->category !== $dto->getCategory()) {
            $data['category'] = $dto->getCategory();
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
        $result = $this->repository->delete($id);

        return $result;
    }
}
