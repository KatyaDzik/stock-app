<?php

namespace App\Repositories;

use App\Dto\ProviderDto;
use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProviderRepository
 * @package App\Repositories
 */
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
        return Provider::with('author')->findOrFail($id);
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

    /**
     * @param ProviderDto $dto
     * @return Provider
     */
    public function save(ProviderDto $dto): Provider
    {
        return Provider::create([
            'name' => $dto->getName(),
            'author_id' => $dto->getAuthor()
        ]);
    }

    /**
     * @param int $id
     * @return null|bool
     */
    public function delete(int $id): ?bool
    {
        $provider = Provider::findOrFail();

        return $provider->delete();
    }

    /**
     * @param int $id
     * @param ProviderDto $dto
     * @return Provider
     */
    public function update(int $id, ProviderDto $dto): Provider
    {
        $provider = Provider::findOrFail($id);

        return $provider->update([
            'name' => $dto->getName(),
            'author_id' => $dto->getAuthor()
        ]);
    }
}
