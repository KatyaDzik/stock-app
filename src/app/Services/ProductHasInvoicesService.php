<?php

namespace App\Services;

use App\Dto\ProductHasInvoiceDto;
use App\Exceptions\InvalidPriceOrNdsOnProductException;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductHasInvoicesRepository;
use App\Services\Validation\ProductValidationService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductHasInvoicesService
 * @package App\Services
 */
class ProductHasInvoicesService
{
    private ProductHasInvoicesRepository $repository;

    /**
     * @param ProductHasInvoicesRepository $repository
     */
    public function __construct(ProductHasInvoicesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $this->repository->delete($id);
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }

    /**
     * @param ProductHasInvoiceDto $dto
     * @return void
     */
    public function saveIncomingProducts(ProductHasInvoiceDto $dto): void
    {
        $invoice_repository = new InvoiceRepository();
        $invoice = $invoice_repository->getById($dto->getInvoice());
        $validator = new ProductValidationService();
        $validator->isProductBelongsToProvider($dto->getProduct(), $invoice->provider_id);

        if ($validator->isProductExistOnInvoice($dto->getProduct(), $dto->getInvoice())) {
            $product_has_invoice = $this->repository->getByProductAndInvoice($dto->getInvoice(), $dto->getProduct());

            if ($product_has_invoice->nds === $dto->getNds() && $product_has_invoice->price == $dto->getPrice()) {
                $dto->setCount($dto->getCount() + $product_has_invoice->count);
                $this->update($product_has_invoice->id, $dto);
            } else {
                throw new InvalidPriceOrNdsOnProductException();
            }

        } else {
            $this->save($dto);
        }
    }

    /**
     * @param int $id
     * @param ProductHasInvoiceDto $dto
     * @return void
     */
    public function update(int $id, ProductHasInvoiceDto $dto): void
    {
        try {
            $this->repository->update($id, $dto);
        } catch (\Exception $exception) {
            throw new ModelNotUpdatedException();
        }
    }

    /**
     * @param ProductHasInvoiceDto $dto
     * @return void
     */
    public function save(ProductHasInvoiceDto $dto): void
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function updateIncomingProducts(int $id, array $data): void
    {
        $product_has_invoice = $this->repository->getById($id);

        $dto = new ProductHasInvoiceDto(
            $data['count'],
            $data['price'],
            $data['nds'],
            $product_has_invoice->product_id,
            $product_has_invoice->invoice_id
        );

        $this->update($id, $dto);
    }

    /**
     * @param int $id
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllByInvoicePaginate(int $id, int $count): LengthAwarePaginator
    {
        return $this->repository->getByInvoicePaginate($id, $count);
    }
}
