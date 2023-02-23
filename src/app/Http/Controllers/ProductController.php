<?php

namespace App\Http\Controllers;

use App\Dto\ProductDto;
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
        $validated = $request->validated();

        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            auth()->user()->id
        );

        $result = $this->service->create($data);

        return response()->json($result, 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->service->read($id);

        return response()->json($result, 200);
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

        $result = $this->service->update($id, $data);

        return response()->json($result, 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return response()->json('deleted', 200);
    }
}
