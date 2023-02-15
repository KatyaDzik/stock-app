<?php

namespace App\Repositories;

use App\Models\Movement;
use App\Repositories\Interfaces\MovementRepositoryInterface;

class MovementRepository implements MovementRepositoryInterface
{
    public function getById($id)
    {
        $movement = Movement::find($id);
        $movement->status;
        return $movement;
    }
}
