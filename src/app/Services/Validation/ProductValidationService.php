<?php

namespace App\Services\Validation;

use App\Exceptions\InvalidProductNameException;
use App\Exceptions\ProductNotExistAtProviderException;
use App\Models\ProductHasInvoices;
use App\Repositories\ProductHasInvoicesRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProviderRepository;

class ProductValidationService
{
    public function isExistProductNameAtProvider(string $name, int $provider_id): bool
    {
        $product_repository = new ProductRepository();
        $product = $product_repository->getByNameAndProvider($name, $provider_id);

        if ($product) {
            throw new InvalidProductNameException();
        }

        return false;
    }

    public function isProductBelongsToProvider(int $product_id, int $provider_id): bool
    {
        $product_repository = new ProductRepository();
        $product = $product_repository->getById($product_id);
        $provider_repository = new ProviderRepository();
        $provider = $provider_repository->getById($provider_id);

        if ($product->provider_id !== $provider->id) {
            throw new ProductNotExistAtProviderException();
        }

        return true;
    }

    public function isProductExistOnInvoice(int $product_id, int $invoice_id): bool
    {
        $repository = new ProductHasInvoicesRepository();

        if ($repository->getByProductAndInvoice($invoice_id, $product_id)) {
            return true;
        }

        return false;
    }
}
