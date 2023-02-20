<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only([
            'category',
            'parent_id'
        ]);

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
        $category = $this->service->read($id);
        if (!$category) {
            $result = [
                'status' => 500,
                'error' => 'not found'
            ];
        } else {
            $result = [
                'status' => 200,
                'data' => $category
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->only([
            'category',
            'parent_id'
        ]);

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


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->delete($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
