<?php

namespace App\Services\Validation;

use App\Exceptions\InvalidProductNameException;
use App\Repositories\ProductRepository;

class ProductValidationService
{
    public static function isExistProductNameAtProvider(string $name, int $provider_id): bool
    {
        $product_repository = new ProductRepository();
        $product = $product_repository->getByNameAndProvider($name, $provider_id);

        if ($product) {
            throw new InvalidProductNameException();
        }

        return false;
    }
}
