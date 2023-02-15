<?php

namespace App\Repositories\Interfaces;

use App\Models\ProductChanges;

interface ProductChangesRepositoryInterface
{
    public function getById($id): ProductChanges;
}
