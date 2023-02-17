<?php

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;

interface ProviderRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Provider|null
     */
    public function getById(int $id): ?Provider;

    /**
     * @param int $id
     * @return Provider|null
     */
    public function getProviderByInvoice(int $id): ?Provider;
}
