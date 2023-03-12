<?php

namespace App\Http\Controllers;

use App\Dto\ProductInStockDto;
use App\Http\Requests\ProductHasStocksRequest;
use App\Services\ProductHasStocksService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class ProductHasStocksController
 * @package App\Http\Controllers
 */
class ProductHasStocksController extends Controller
{
    private ProductHasStocksService $service;

    /**
     * @param ProductHasStocksService $service
     */
    public function __construct(ProductHasStocksService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $id
     * @return View
     */
    public function getAllFromStock(int $id): View
    {
        $products = $this->service->getAllPaginate($id, 5);

        return view('user/stock-profile')->with('products', $products)->with('id', $id);
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

    /**
     * @param ProductHasStocksRequest $request
     * @return JsonResponse
     */
    public function store(ProductHasStocksRequest $request): JsonResponse
    {
        $data = new ProductInStockDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('stock_id'),
        );

        $this->service->create($data);

        return response()->json('added successfully');
    }

    /**
     * @param int $id
     * @param ProductHasStocksRequest $request
     * @return JsonResponse
     */
    public function update(int $id, ProductHasStocksRequest $request): JsonResponse
    {
        $request->validated();

        $data = new ProductInStockDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('stock_id'),
        );

        $this->service->update($id, $data);

        return response()->json('updated successfully');
    }

    /**
     * @param int $id
     * @param ProductHasStocksRequest $request
     * @return JsonResponse
     */
    public function storeReceivedGoods(int $id, ProductHasStocksRequest $request): void
    {
        $data = new ProductInStockDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('stock_id'),
        );

        $this->service->saveReceivedGoods($id, $data);
    }
}
