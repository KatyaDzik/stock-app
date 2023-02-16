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
     * @param $id
     * @return Provider|null
     */
    public function getById($id): ?Provider;

    /**
     * @param $id
     * @return Provider|null
     */
    public function getProviderByInvoice($id): ?Provider;
}
