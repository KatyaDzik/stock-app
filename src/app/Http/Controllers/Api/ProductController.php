<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    private ProductService $service;

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
        $this->service->create($request->validated());

        return response()->json(['message' => 'created successfully']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->service->read($id);

        return response()->json($product);
    }

    /**
     * @param int $id
     * @param ProductRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(int $id, ProductRequest $request): JsonResponse
    {
        $this->service->update($id, $request->validated());

        return response()->json(['message' => 'updated successfully']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'deleted successfully']);
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $products = $this->service->getAll();

        return response()->json(compact('products'));
    }
}
