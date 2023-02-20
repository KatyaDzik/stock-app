<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductChanges;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only([
            'product',
            'category_id'
        ]);
        $data['author_id'] = auth()->user()->id;

        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->create($data);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->service->read($id);
        if (!$product) {
            $result = [
                'status' => 500,
                'error' => 'not found'
            ];
        } else {
            $result = [
                'status' => 200,
                'data' => $product
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->only([
            'product',
            'category_id'
        ]);
        $data['editor_id'] = auth()->user()->id;

        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->update($data, $id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
