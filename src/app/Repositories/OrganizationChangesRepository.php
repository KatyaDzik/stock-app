<?php

namespace App\Repositories;

use App\Models\OrganizationChanges;
use App\Repositories\Interfaces\OrganizationChangesRepositoryInterface;

class OrganizationChangesRepository implements OrganizationChangesRepositoryInterface
{
    public function getById($id): ?OrganizationChanges
    {
        return OrganizationChanges::find($id);
    }
}
