<?php

namespace App\Repositories;

use App\Models\Movement;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MovementRepository implements MovementRepositoryInterface
{
    public function getById($id): Movement
    {
        return Movement::with(‘status’)->find($id);
    }

    public function getMovementByInvoice($id): Movement
    {
        return Movement::select('movements.*')
            ->join('invoices', 'invoices.customer_id', '=', 'movements.id')
            ->where('invoices.id', '=', $id)
            ->first();
    }

    public function getMovementsByStatus($id): Collection
    {
        return Movement::select('movements.*')
            ->join('statuses', 'movements.status_id', '=', 'statuses.id')
            ->where('statuses.id', '=', $id)
            ->get();
    }
}
