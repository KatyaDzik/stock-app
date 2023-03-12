<?php

namespace App\Repositories;

use App\Dto\CustomerDto;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Customer::all();
    }

    /**
     * @param int $id
     * @return null|Customer
     */
    public function getById(int $id): ?Customer
    {
        return Customer::with('author')->findOrFail($id);
    }

    /**
     * @param string $name
     * @return null|Customer
     */
    public function getByName(string $name): ?Customer
    {
        return Customer::where('name', $name)->first();
    }

    /**
     * @param int $id
     * @return null|Customer
     */
    public function getCustomerByInvoice(int $id): ?Customer
    {
        return Customer::whereHas('invoices', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

    /**
     * @param CustomerDto $dto
     * @return Customer
     */
    public function save(CustomerDto $dto): Customer
    {
        return Customer::create([
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
        $customer = Customer::findOrFail();

        return $customer->delete();
    }

    /**
     * @param int $id
     * @param CustomerDto $dto
     * @return Customer
     */
    public function update(int $id, CustomerDto $dto): Customer
    {
        $provider = Customer::findOrFail($id);

        return $provider->update([
            'name' => $dto->getName(),
            'author_id' => $dto->getAuthor()
        ]);
    }
}
