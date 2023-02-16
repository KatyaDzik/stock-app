<?php

namespace App\Repositories;

use App\Models\OrganizationChanges;
use App\Repositories\Interfaces\OrganizationChangesRepositoryInterface;

class OrganizationChangesRepository implements OrganizationChangesRepositoryInterface
{
    /**
     * @param $id
     * @return OrganizationChanges|null
     */
    public function getById($id): ?OrganizationChanges
    {
        return OrganizationChanges::find($id);
    }
}
