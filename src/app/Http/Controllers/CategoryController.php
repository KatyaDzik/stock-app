<?php

namespace App\Http\Controllers;

use App\Dto\CategoryDto;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = new CategoryDto(
            $request->input('category'),
            $request->input('parent_id')
        );

        try {
            $category = $this->service->create($data);
        } catch (\Exception $e) {
            throw \Exception($e->getMessage());
        }

        return response()->json(['category' => new CategoryResource($category)], 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->service->read($id);
        } catch (\Exception $e) {
            throw \Exception($e->getMessage());
        }

        return response()->json(['category' => new CategoryResource($category)], 200);
    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $data = new CategoryDto(
            $request->input('category'),
            $request->input('parent_id')
        );

        try {
            $category = $this->service->update($data, $id);
        } catch (\Exception $e) {
            throw \Exception($e->getMessage());
        }

        return response()->json(['category' => new CategoryResource($category)], 200);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $category = $this->service->delete($id);
        } catch (\Exception $e) {
            throw \Exception($e->getMessage());
        }

        return response()->json('deleted', 200);
    }
}
