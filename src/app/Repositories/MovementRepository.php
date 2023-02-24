<?php

namespace App\Repositories;

use App\Models\Movement;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MovementRepository
 * @package App\Repositories
 */
class MovementRepository implements MovementRepositoryInterface
{
    /**
     * @param int $id
     * @return Movement|null
     */
    public function getById(int $id): ?Movement
    {
        return Movement::with('status')->find($id);
    }

    /**
     * @param int $id
     * @return Movement|null
     */
    public function getMovementByInvoice(int $id): ?Movement
    {
        return Movement::whereHas('invoice', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getMovementsByStatus(int $id): Collection
    {
        return Movement::where('status_id', $id)->get();
    }
}
