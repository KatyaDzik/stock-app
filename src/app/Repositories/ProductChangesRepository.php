<?php

namespace App\Repositories;

use App\Models\ProductChanges;
use App\Repositories\Interfaces\ProductChangesRepositoryInterface;

class ProductChangesRepository implements ProductChangesRepositoryInterface
{
    /**
     * @param int $id
     * @return ProductChanges|null
     */
    public function getById(int $id): ?ProductChanges
    {
        return ProductChanges::find($id);
    }

    public function save(array $data)
    {
        $productChange = new ProductChanges();
        $productChange->fill($data);
        $productChange->save();

        return $productChange;
    }
}
