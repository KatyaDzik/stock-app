<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Movement;
use App\Models\Status;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MovementRepository implements MovementRepositoryInterface
{
    public function getById($id): ?Movement
    {
        return Movement::with(‘status’)->find($id);
    }

    public function getMovementByInvoice($id): ?Movement
    {
        return Invoice::find($id)->movement;
    }

    public function getMovementsByStatus($id): Collection
    {
        return Status::find(id)->movements;
    }
}
