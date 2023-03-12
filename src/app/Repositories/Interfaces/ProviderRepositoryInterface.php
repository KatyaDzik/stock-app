<?php

namespace App\Repositories\Interfaces;

use App\Dto\ProviderDto;
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

    /**
     * @param ProviderDto $dto
     * @return Provider
     */
    public function save(ProviderDto $dto): Provider;

    /**
     * @param int $id
     * @return null|bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     * @param ProviderDto $dto
     * @return bool
     */
    public function update(int $id, ProviderDto $dto): bool;
}
