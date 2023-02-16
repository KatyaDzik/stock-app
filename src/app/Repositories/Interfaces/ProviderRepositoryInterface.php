<?php

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;

interface ProviderRepositoryInterface
{
    public function getAll(): Collection;

    public function getById($id): ?Provider;

    public function getProviderByInvoice($id): ?Provider;
}
