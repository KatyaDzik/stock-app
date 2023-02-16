<?php

namespace App\Repositories\Interfaces;

use App\Models\OrganizationChanges;

interface OrganizationChangesRepositoryInterface
{
    /**
     * @param $id
     * @return OrganizationChanges|null
     */
    public function getById($id): ?OrganizationChanges;
}
