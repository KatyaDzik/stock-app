<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository implements StatusRepositoryInterface
{
    public function getALL(): Collection
    {
        return Status::all();
    }

    public function getById($id): ?Status
    {
        return Status::find($id);
    }

}
