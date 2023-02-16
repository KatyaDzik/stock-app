<?php

namespace App\Repositories\Interfaces;

use App\Models\ProductChanges;

interface ProductChangesRepositoryInterface
{
    /**
     * @param $id
     * @return ProductChanges|null
     */
    public function getById($id): ?ProductChanges;
}
