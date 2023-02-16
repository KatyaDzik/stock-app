<?php

namespace App\Repositories\Interfaces;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface
{
    /**
     * @param $id
     * @return Movement|null
     */
    public function getById($id): ?Movement;

    /**
     * @param $id
     * @return Movement|null
     */
    public function getMovementByInvoice($id): ?Movement;

    /**
     * @param $id
     * @return Collection
     */
    public function getMovementsByStatus($id): Collection;
}
