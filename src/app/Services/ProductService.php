<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Models\Product;
use App\Repositories\ProductChangesRepository;
use App\Repositories\ProductRepository;
use App\Services\PostServiceInterface\ProductServiceInterface;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    private $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param ProductDto $dto
     * @return Product|null
     */
    public function create(ProductDto $dto): ?Product
    {
        $result = $this->repository->save($dto);

        return $result;
    }


    /**
     * @param int $id
     * @return Product|null
     */
    public function read(int $id): ?Product
    {
        $product = $this->repository->getById($id);

        return $product;
    }


    /**
     * @param array $data
     * @param int $id
     * @return Product|null
     * @throws \Exception
     */
    public function update(int $id, ProductDto $dto): ?Product
    {
        $product = $this->repository->getById($id);
        $data_product_change = [
            'product' => $product->product,
            'product_id' => $product->id,
            'editor_id' => $dto->getAuthor()
        ];

        $product_change_repository = new ProductChangesRepository();

        try {
            DB::beginTransaction();

            $product_change_repository->save($data_product_change);
            $result = $this->repository->update($id, $dto);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('not updated ' . $e);
        }

        return $result;
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);

        return $result;
    }
}
