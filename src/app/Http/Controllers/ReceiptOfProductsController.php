<?php

namespace App\Http\Controllers;

use App\Services\ReceiptOfProductsService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class ReceiptOfProductsController
 * @package App\Http\Controllers
 */
class ReceiptOfProductsController extends Controller
{
    private ReceiptOfProductsService $service;

    /**
     * @param ReceiptOfProductsService $service
     */
    public function __construct(ReceiptOfProductsService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $products = $this->service->getAllPaginate(5);

        return view('user/product-receipts', compact('products'));
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
