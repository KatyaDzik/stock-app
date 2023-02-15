<?php

namespace App\Repositories\Interfaces;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

interface StatusRepositoryInterface
{
    public function getALL(): Collection;

    public function getById($id): Status;
}
