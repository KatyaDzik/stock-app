<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StatusRepository
 * @package App\Repositories
 */
class StatusRepository implements StatusRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection
    {
        return Status::all();
    }

    /**
     * @param int $id
     * @return Status|null
     */
    public function getById(int $id): ?Status
    {
        return Status::find($id);
    }
}
