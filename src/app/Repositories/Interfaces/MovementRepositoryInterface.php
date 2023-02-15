<?php

namespace App\Repositories\Interfaces;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface
{
    public function getById($id): Movement;

    public function getMovementByInvoice($id): Movement;

    public function getMovementsByStatus($id): Collection;
}
