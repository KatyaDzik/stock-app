<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    public function getALL()
    {
        return Status::all();
    }

    public function getMovements($id)
    {
        return $this->getById($id)->movements;
    }

    public function getById($id)
    {
        return Status::find($id);
    }

}
