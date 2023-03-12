<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Dto\ProductToInvoiceDto;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotUpdatedException;
use App\Repositories\ProductHasInvoicesRepository;
use App\Repositories\ProductRepository;
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
     * @param ProductToInvoiceDto $dto
     * @return void
     */
    public function create(ProductToInvoiceDto $dto): void
    {
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            throw new ModelNotCreatedException();
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function saveIncomingProducts(array $data): void
    {
        DB::transaction(function () use ($data) {
            try {
                foreach ($data as $el) {
                    $product_repository = new ProductRepository();
                    $product = $product_repository->getById($el->getProduct());
                    $sku = md5($product->name . $product->category_id . $el->getPrice() . $el->getNds());

                    if ($this->repository->getByProductSku($sku)->isEmpty()) {

                        if ($this->repository->getByProduct($el->getProduct())->isEmpty()) {
                            $product_repository->update($product->id,
                                new ProductDto($product->name, $sku, $product->category_id, $product->author_id));
                        } else {
                            $new_product = $product_repository->save(new ProductDto($product->name, $sku,
                                $product->category_id,
                                auth('web')->user()->id));
                            $el->setProduct($new_product->id);
                        }

                        $this->repository->save($el);

                    } else {
                        $product_has_invoice = $this->repository->getByProductSku($sku);

                        if ($product_has_invoice->containsStrict('invoice_id', $el->getInvoice())) {
                            $this->repository->update($product_has_invoice[0]->id,
                                new ProductToInvoiceDto($product_has_invoice[0]->count + $el->getCount(),
                                    $product_has_invoice[0]->price, $product_has_invoice[0]->nds,
                                    $product_has_invoice[0]->product_id, $product_has_invoice[0]->invoice_id));
                        } else {
                            $product = $product_repository->getBySku($sku);
                            $el->setProduct($product->id);
                            $this->repository->save($el);
                        }
                    }
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        });
    }

    /**
     * @param int $id
     * @param ProductToInvoiceDto $dto
     * @return void
     */
    public function update(int $id, ProductToInvoiceDto $dto): void
    {
        try {
            $this->repository->update($id, $dto);
        } catch (\Exception $e) {
            throw new ModelNotUpdatedException();
        }
    }
}
