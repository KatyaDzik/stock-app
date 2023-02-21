<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\PostServiceInterface\CategoryServiceInterface;
use App\Services\PostServiceInterface\PostServiceInterface;
use Illuminate\Support\Facades\Validator;

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
     * @param CategoryDto $data
     * @param int $id
     * @return Category|null
     */
    public function update(CategoryDto $data, int $id): ?Category
    {
        $result = $this->repository->update($data, $id);

        return $result;
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
