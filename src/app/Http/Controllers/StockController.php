<?php

namespace App\Http\Controllers;

use App\Dto\StockDto;
use App\Http\Requests\StockRequest;
use App\Services\StockService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class StockController
 * @package App\Http\Controllers
 */
class StockController extends Controller
{
    private StockService $service;

    /**
     * @param StockService $service
     */
    public function __construct(StockService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $stocks = $this->service->getAllPaginate(5);

        return view('user/stocks', compact('stocks'));
    }

    /**
     * @param StockRequest $request
     * @return JsonResponse
     */
    public function store(StockRequest $request): JsonResponse
    {
        $request->validated();

        $data = new StockDto(
            $request->input('name'),
            $request->input('address'),
        );

        $result = $this->service->create($data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @param StockRequest $request
     * @return JsonResponse
     */
    public function update(int $id, StockRequest $request): JsonResponse
    {
        $request->validated();

        $data = new StockDto(
            $request->input('name'),
            $request->input('address'),
        );

        $result = $this->service->update($id, $data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('deleted');
    }
}
