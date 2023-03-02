<?php

namespace App\Http\Controllers\Api;

use App\Dto\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

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
        $request->validated();

        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            auth('web')->user()->id
        );

        $result = $this->service->create($data);

        return response()->json($result);
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
        $request->validated();

        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            auth('web')->user()->id
        );

        $result = $this->service->update($id, $data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('deleted', 200);
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $products = $this->service->getAll();

        return view('user/products', compact('products'));
    }
}
