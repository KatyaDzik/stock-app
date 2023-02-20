<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductChangesRepository;
use App\Repositories\ProductRepository;
use App\Services\PostServiceInterface\PostServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductService implements PostServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }


    /**
     * @param array $data
     * @return Product|null
     * @throws \Exception
     */
    public function create(array $data): ?Product
    {
        $validator = Validator::make($data, [
            'product' => ['required', 'string', 'min:2', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $result = $this->repository->save($data);

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
    public function update(array $data, int $id): ?Product
    {
        $validator = Validator::make($data, [
            'product' => ['string', 'min:2', 'max:255'],
            'category_id' => ['exists:categories,id'],
            'editor_id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $product = $this->repository->getById($id);
        $data_product_change = [
            'product' => $product->product,
            'product_id' => $product->id,
            'editor_id' => $data ['editor_id']
        ];

        $product_change_repository = new ProductChangesRepository();

        try {
            DB::beginTransaction();

            $product_change_repository->save($data_product_change);
            $result = $this->repository->update($data, $id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('not updated ' . $e);
        }

        return $result;
    }


    /**
     * @param int $id
     * @return Product|null
     * @throws \Exception
     */
    public function delete(int $id): ?Product
    {
        $result = $this->repository->delete($id);

        return $result;
    }
}
