<?php

namespace App\Repositories;

use App\Dto\InvoiceDto;
use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class InvoiceRepository
 * @package App\Repositories
 */
class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Invoice::all();
    }

    /**
     * @param int $id
     * @return Invoice|null
     */
    public function getById(int $id): ?Invoice
    {
        return Invoice::findOrFail($id);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByCustomer(int $id): Collection
    {
        return Invoice::where('customer_id', $id)->get();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByProvider(int $id): Collection
    {
        return Invoice::where('provider_id', $id)->get();
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return Invoice::paginate($count);
    }

    /**
     * @param InvoiceDto $dto
     * @return Invoice
     */
    public function save(InvoiceDto $dto): Invoice
    {
        return Invoice::create([
            'number' => $dto->getNumber(),
            'date' => $dto->getDate(),
            'from' => $dto->getFrom(),
            'to' => $dto->getTo(),
            'provider_id' => $dto->getProvider(),
            'customer_id' => $dto->getCustomer(),
            'status_id' => $dto->getStatus(),
            'type_id' => $dto->getType(),
        ]);
    }

    /**
     * @param int $id
     * @param InvoiceDto $dto
     * @return bool
     */
    public function update(int $id, InvoiceDto $dto): bool
    {
        $invoice = Invoice::findOrFail($id);

        return $invoice->update([
            'number' => $dto->getNumber(),
            'date' => $dto->getDate(),
            'from' => $dto->getFrom(),
            'to' => $dto->getTo(),
            'provider_id' => $dto->getProvider(),
            'customer_id' => $dto->getCustomer(),
            'status_id' => $dto->getStatus(),
            'type_id' => $dto->getType(),
        ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = Invoice::findOrFail($id);

        return $product->delete();
    }
}
