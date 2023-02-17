<?php

namespace App\Repositories\Interfaces;

use App\Models\ProductChanges;

interface ProductChangesRepositoryInterface
{
    /**
     * @param int $id
     * @return ProductChanges|null
     */
    public function getById(int $id): ?ProductChanges;
}
