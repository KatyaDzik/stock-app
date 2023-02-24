<?php

namespace App\Repositories;

use App\Dto\CategoryDto;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
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
        return Category::findOrFail($id);
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
        $category = Category::findOrFail($id);

        return $category->update($data);
    }

    /**
     * @param CategoryDto $data
     * @return Category|null
     */
    public function save(CategoryDto $data): ?Category
    {
        return Category::create([
            'name' => $data->getName(),
            'parent_id' => $data->getParent()
        ]);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $category = Category::findOrFail();

        return $category->delete();
    }
}
