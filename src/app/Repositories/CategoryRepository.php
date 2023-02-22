<?php

namespace App\Repositories;

use App\Dto\CategoryDto;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
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
        return Category::where('parent_id', $id)->get();
    }


    /**
     * @param int $id
     * @param array $data
     * @return Category|null
     */
    public function update(int $id, array $data): ?Category
    {
        $category = Category::find($id)->fill($data);
        $category->update();

        return $category->fresh();
    }


    /**
     * @param CategoryDto $data
     * @return Category|null
     */
    public function save(CategoryDto $data): ?Category
    {
        $category = new Category();
        $category->name = $data->getName();
        $category->parent_id = $data->getParent();
        $category->save();

        return $category->fresh();
    }


    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $category = Category::where('id', $id)->delete();

        return $category;
    }
}
