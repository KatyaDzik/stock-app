<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInteface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface, PostRepositoryInteface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @param int $id
     * @return Category|null
     */
    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * @param int $id
     * @return Category|null
     */
    public function getSubcategories(int $id): ?Collection
    {
        return Category::where('parent_id', $id)->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Category|null
     */
    public function update(array $data, int $id): ?Category
    {
        $category = Category::find($id);
        $category->fill($data)->save();

        return $category;
    }

    /**
     * @param array $data
     * @return Category|null
     */
    public function save(array $data): ?Category
    {
        $category = new Category();
        $category->fill($data);
        $category->save();

        return $category;
    }


    /**
     * @param int $id
     * @return Category|null
     * @throws Exception
     */
    public function delete(int $id): ?Category
    {
        $category = Category::find($id);

        if (!$category) {
            throw new \Exception('Unable to delete post data');
        }

        $category->delete();

        return $category;
    }
}
