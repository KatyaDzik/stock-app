<?php

namespace App\Http\Controllers;

use App\Dto\ProductToInvoiceDto;
use App\Http\Requests\ProductToInvoiceRequest;
use App\Services\ProductHasInvoicesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


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
    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }

    public function store(int $id, Request $request): void
    {
        $data = json_decode($request->input('data'));

        $products = [];
        foreach ($data as $el) {
            $product = new ProductToInvoiceDto(
                $el->count,
                $el->price,
                $el->nds,
                $el->product_id,
                $id,
            );
            $products[] = $product;
        }

        $this->service->saveProducts($products);
    }

    /**
     * @param int $id
     * @param ProductToInvoiceRequest $request
     * @return JsonResponse
     */
    public function update(int $id, ProductToInvoiceRequest $request): JsonResponse
    {
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
