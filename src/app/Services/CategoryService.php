<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\PostServiceInterface\PostServiceInterface;
use Illuminate\Support\Facades\Validator;

class CategoryService implements PostServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }


    /**
     * @param array $data
     * @return Category|null
     * @throws \Exception
     */
    public function create(array $data): ?Category
    {
        $validator = Validator::make($data, [
            'category' => ['required', 'string', 'min:2', 'max:255'],
            'parent_id' => ['exists:categories,id']
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

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
     * @param array $data
     * @param int $id
     * @return Category|null
     * @throws \Exception
     */
    public function update(array $data, int $id): ?Category
    {
        $validator = Validator::make($data, [
            'category' => ['required', 'string', 'min:2', 'max:255'],
            'parent_id' => ['exists:categories,id']
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $result = $this->repository->update($data, $id);

        return $result;
    }


    /**
     * @param int $id
     * @return Category|null
     * @throws \Exception
     */
    public function delete(int $id): ?Category
    {
        $result = $this->repository->delete($id);

        return $result;
    }
}
