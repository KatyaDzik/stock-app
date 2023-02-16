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
     * @param $id
     * @return Product|null
     */
    public function getById($id): ?Product;

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByCategory($id): Collection;

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByInvoice($id): Collection;

    /**
     * @param $id
     * @return Collection
     */
    public function getProductsByStock($id): Collection;
}
