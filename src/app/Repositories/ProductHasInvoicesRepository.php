<?php

namespace App\Repositories;

use App\Dto\ProductHasInvoiceDto;
use App\Models\Product;
use App\Models\ProductHasInvoices;
use App\Repositories\Interfaces\ProductHasInvoicesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ProductHasInvoicesRepository
 * @package App\Repositories
 */
class ProductHasInvoicesRepository implements ProductHasInvoicesRepositoryInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function getByInvoice(int $id): Collection
    {
        return ProductHasInvoices::where('invoice_id', $id)->get();
    }

    /**
     * @param int $id
     * @return ProductHasInvoices
     */
    public function getById(int $id): ProductHasInvoices
    {
        return ProductHasInvoices::findOrFail($id);
    }

    /**
     * @param int $id
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getByInvoicePaginate(int $id, int $count): LengthAwarePaginator
    {
        return ProductHasInvoices::where('invoice_id', $id)->with('product')->paginate($count);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product_has_invoices = ProductHasInvoices::findOrFail($id);

        return $product_has_invoices->delete();
    }

    /**
     * @param ProductHasInvoiceDto $dto
     * @return null|ProductHasInvoices
     */
    public function save(ProductHasInvoiceDto $dto): ?ProductHasInvoices
    {
        return ProductHasInvoices::create([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
            'invoice_id' => $dto->getInvoice()
        ]);
    }

    /**
     * @param int $id
     * @param ProductHasInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductHasInvoiceDto $dto): bool
    {
        $product = ProductHasInvoices::findOrFail($id);

        return $product->update([
            'count' => $dto->getCount(),
            'price' => $dto->getPrice(),
            'nds' => $dto->getNds(),
            'product_id' => $dto->getProduct(),
            'invoice_id' => $dto->getInvoice()
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getByProduct(int $id): ?ProductHasInvoices
    {
        return ProductHasInvoices::where('product_id', $id)->first();
    }

    /**
     * @param int $invoice_id
     * @param int $product_id
     * @return mixed
     */
    public function getByProductAndInvoice(int $invoice_id, int $product_id)
    {
        return ProductHasInvoices::where('invoice_id', $invoice_id)->where('product_id', $product_id)->first();
    }
}
