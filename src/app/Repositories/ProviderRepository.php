<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class ProviderRepository implements ProviderRepositoryInterface
{
    public function getAll(): Collection
    {
        return Provider::all();
    }

    public function getById($id): ?Provider
    {
        return Provider::with('author')->find($id);
    }

    public function getProviderByInvoice($id): ?Provider
    {
        return Invoice::find($id)->provider;
    }

}
