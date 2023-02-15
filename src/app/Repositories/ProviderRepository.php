<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function getALL()
    {
        return Provider::all();
    }

    public function invoices($id)
    {
        return $this->getById($id)->invoices;
    }

    public function getById($id)
    {
        $provider = Provider::find($id);
        $provider->author();
        return $provider;
    }

}
