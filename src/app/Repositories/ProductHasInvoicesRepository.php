<?php

namespace App\Repositories;

use App\Dto\ProductToInvoiceDto;
use App\Models\ProductHasInvoices;
use App\Repositories\Interfaces\ProductHasInvoicesRepositoryInterface;
use Illuminate\Support\Collection;


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
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product_has_invoices = ProductHasInvoices::findOrFail($id);

        return $product_has_invoices->delete();
    }

    /**
     * @param ProductToInvoiceDto $dto
     * @return null|ProductHasInvoices
     */
    public function save(ProductToInvoiceDto $dto): ?ProductHasInvoices
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
     * @param ProductToInvoiceDto $dto
     * @return bool
     */
    public function update(int $id, ProductToInvoiceDto $dto): bool
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
    public function getByProduct(int $id)
    {
        return ProductHasInvoices::where('product_id', $id)->get();
    }

    /**
     * @param string $sku
     * @return mixed
     */
    public function getByProductSku(string $sku)
    {
        return ProductHasInvoices::whereHas('product', function ($q) use ($sku) {
            $q->where('sku', $sku);
        })->get();
    }
}
