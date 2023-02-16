<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Movement;
use App\Models\Status;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MovementRepository implements MovementRepositoryInterface
{
    /**
     * @param $id
     * @return Movement|null
     */
    public function getById($id): ?Movement
    {
        return Movement::with(‘status’)->find($id);
    }

    /**
     * @param $id
     * @return Movement|null
     */
    public function getMovementByInvoice($id): ?Movement
    {
        return Invoice::find($id)->movement;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getMovementsByStatus($id): Collection
    {
        return Status::find(id)->movements;
    }
}
