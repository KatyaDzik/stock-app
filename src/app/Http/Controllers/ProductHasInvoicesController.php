<?php

namespace App\Http\Controllers;

use App\Dto\ProductToInvoiceDto;
use App\Http\Requests\ProductToInvoiceRequest;
use App\Services\ProductHasInvoicesService;
use Illuminate\Http\JsonResponse;


/**
 * Class ProductHasInvoices
 * @package App\Http\Controllers
 */
class ProductHasInvoicesController extends Controller
{
    private ProductHasInvoicesService $service;

    /**
     * @param ProductHasInvoicesService $service
     */
    public function __construct(ProductHasInvoicesService $service)
    {
        $this->service = $service;
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
     * @param ProductToInvoiceRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(ProductToInvoiceRequest $request): JsonResponse
    {
        $request->validated();

        $data = new ProductToInvoiceDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('invoice_id'),
        );

        $this->service->create($data);

        return response()->json('product added');
    }

    /**
     * @param int $id
     * @param ProductToInvoiceRequest $request
     * @return JsonResponse
     */
    public function update(int $id, ProductToInvoiceRequest $request): JsonResponse
    {
        $request->validated();

        $data = new ProductToInvoiceDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('invoice_id'),
        );

        $this->service->update($id, $data);

        return response()->json('product added');
    }
}
