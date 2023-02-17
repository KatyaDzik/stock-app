<?php

namespace App\Repositories\Interfaces;

use App\Models\OrganizationChanges;

interface OrganizationChangesRepositoryInterface
{
    /**
     * @param int $id
     * @return OrganizationChanges|null
     */
    public function getById(int $id): ?OrganizationChanges;
}
