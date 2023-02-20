<?php

namespace App\Repositories;

use App\Models\OrganizationChanges;
use App\Repositories\Interfaces\OrganizationChangesRepositoryInterface;

class OrganizationChangesRepository implements OrganizationChangesRepositoryInterface
{
    /**
     * @param int $id
     * @return OrganizationChanges|null
     */
    public function getById(int $id): ?OrganizationChanges
    {
        return OrganizationChanges::find($id);
    }
}
