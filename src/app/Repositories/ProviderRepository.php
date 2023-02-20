<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProviderRepository implements ProviderRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Provider::all();
    }

    /**
     * @param int $id
     * @return Provider|null
     */
    public function getById(int $id): ?Provider
    {
        return Provider::with('author')->find($id);
    }

    /**
     * @param int $id
     * @return Provider|null
     */
    public function getProviderByInvoice(int $id): ?Provider
    {
        return Provider::whereHas('invoices', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

}
