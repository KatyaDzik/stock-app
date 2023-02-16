<?php

namespace App\Repositories;

use App\Models\Invoice;
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
     * @param $id
     * @return Provider|null
     */
    public function getById($id): ?Provider
    {
        return Provider::with('author')->find($id);
    }

    /**
     * @param $id
     * @return Provider|null
     */
    public function getProviderByInvoice($id): ?Provider
    {
        return Provider::whereHas('invoices', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

}
