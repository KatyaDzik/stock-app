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
}
