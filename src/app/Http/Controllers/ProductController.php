<?php

namespace App\Http\Controllers;

use App\Dto\ProductDto;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }


    /**
     * @param ProductRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            auth()->user()->id
        );

        try {
            $product = $this->service->create($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json(['category' => new ProductResource($product)], 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->service->read($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json(['category' => new ProductResource($product)], 200);
    }


    /**
     * @param int $id
     * @param ProductRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(int $id, ProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            auth()->user()->id
        );

        try {
            $product = $this->service->update($id, $data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json(['product' => new ProductResource($product)], 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $product = $this->service->delete($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json('deleted', 200);
    }
}
