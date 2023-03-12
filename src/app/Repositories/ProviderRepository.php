<?php

namespace App\Repositories;

use App\Dto\ProviderDto;
use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param string $name
     * @return null|Provider
     */
    public function getByName(string $name): ?Provider
    {
        return Provider::where('name', $name)->first();
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return Provider::paginate($count);
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
     * @return bool
     */
    public function delete(int $id): bool
    {
        $provider = Provider::findOrFail($id);

        return $provider->delete();
    }

    /**
     * @param int $id
     * @param ProviderDto $dto
     * @return bool
     */
    public function update(int $id, ProviderDto $dto): bool
    {
        $provider = Provider::findOrFail($id);

        return $provider->update([
            'name' => $dto->getName(),
            'author_id' => $dto->getAuthor()
        ]);
    }
}
