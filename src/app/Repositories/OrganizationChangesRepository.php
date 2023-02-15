<?php

namespace App\Repositories;

use App\Models\OrganizationChanges;
use App\Repositories\Interfaces\OrganizationChangesRepositoryInterface;

class OrganizationChangesRepository implements OrganizationChangesRepositoryInterface
{
    public function getById($id)
    {
        return OrganizationChanges::find($id);
    }
}
