<?php

namespace App\Http\Controllers;

use App\Dto\CategoryDto;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private CategoryService $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $request->validated();

        $data = new CategoryDto(
            $request->input('name'),
            $request->input('parent_id')
        );

        $result = $this->service->create($data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->service->read($id);

        return response()->json($result, 200);
    }

    /**
     * @param int $id
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function update(int $id, CategoryRequest $request): JsonResponse
    {
        $request->validated();

        $data = new CategoryDto(
            $request->input('name'),
            $request->input('parent_id')
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
        $this->service->delete($id);

        return response()->json('deleted', 200);
    }
}
