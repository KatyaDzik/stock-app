<?php

namespace App\Repositories\Interfaces;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Product|null
     */
    public function getById(int $id): ?Product;

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByCategory(int $id): Collection;

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByInvoice(int $id): Collection;

    /**
     * @param int $id
     * @return Collection
     */
    public function getProductsByStock(int $id): Collection;
}
