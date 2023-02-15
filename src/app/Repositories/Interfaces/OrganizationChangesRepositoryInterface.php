<?php

namespace App\Repositories\Interfaces;

use App\Models\OrganizationChanges;

interface OrganizationChangesRepositoryInterface
{
    public function getById($id): OrganizationChanges;
}
