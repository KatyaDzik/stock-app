<?php

namespace App\Services\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void;

    /**
     * @param int $id
     * @return Product
     */
    public function read(int $id): Product;

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator;
}
