<?php

namespace App\Repositories\Interfaces;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

interface StatusRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getALL(): Collection;

    /**
     * @param $id
     * @return Status|null
     */
    public function getById($id): ?Status;
}
