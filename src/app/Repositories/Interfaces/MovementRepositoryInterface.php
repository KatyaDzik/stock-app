<?php

namespace App\Repositories\Interfaces;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface
{
    /**
     * @param int $id
     * @return Movement|null
     */
    public function getById(int $id): ?Movement;

    /**
     * @param int $id
     * @return Movement|null
     */
    public function getMovementByInvoice(int $id): ?Movement;

    /**
     * @param int $id
     * @return Collection
     */
    public function getMovementsByStatus(int $id): Collection;
}
