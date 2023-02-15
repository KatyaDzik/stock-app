<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class ProviderRepository implements ProviderRepositoryInterface
{
    public function getALL(): Collection
    {
        return Provider::all();
    }

    public function getById($id): Provider
    {
        return Provider::with('author')->find($id);
    }

    public function getProviderByInvoice($id): Provider
    {
        return Provider::select('providers.*')
            ->join('invoices', 'invoices.provider_id', '=', 'providers.id')
            ->where('invoices.id', '=', $id)
            ->first();
    }

}
