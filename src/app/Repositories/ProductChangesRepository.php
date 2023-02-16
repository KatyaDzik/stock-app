<?php

namespace App\Repositories;

use App\Models\ProductChanges;
use App\Repositories\Interfaces\ProductChangesRepositoryInterface;

class ProductChangesRepository implements ProductChangesRepositoryInterface
{
    /**
     * @param $id
     * @return ProductChanges|null
     */
    public function getById($id): ?ProductChanges
    {
        return ProductChanges::find($id);
    }
}
