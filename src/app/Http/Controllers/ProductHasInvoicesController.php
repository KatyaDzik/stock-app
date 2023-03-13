<?php

namespace App\Http\Controllers;

use App\Dto\ProductHasInvoiceDto;
use App\Http\Requests\ProductHasInvoiceRequest;
use App\Services\ProductHasInvoicesService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


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

//    public function store(int $id, Request $request): void
//    {
//        $data = json_decode($request->input('data'));
//
//        $products = [];
//        foreach ($data as $el) {
//            $product = new ProductHasInvoiceDto(
//                $el->count,
//                $el->price,
//                $el->nds,
//                $el->product_id,
//                $id,
//            );
//            $products[] = $product;
//        }
//
//        $this->service->saveIncomingProducts($products);
//    }

//    /**
//     * @param int $id
//     * @param ProductHasInvoiceRequest $request
//     * @return JsonResponse
//     */
//    public function update(int $id, ProductHasInvoiceRequest $request): JsonResponse
//    {
//        $data = new ProductHasInvoiceDto(
//            $request->input('count'),
//            $request->input('price'),
//            $request->input('nds'),
//            $request->input('product_id'),
//            $request->input('invoice_id'),
//        );
//
//        $this->service->update($id, $data);
//
//        return response()->json('product added');
//    }

    public function getAllIncomingProducts(int $id): View
    {
        $products = $this->service->getAllByInvoicePaginate($id, 5);

        return view('user/invoice/manage-incoming-products')->with('products', $products)->with('id', $id);
    }

    public function storeIncomingProducts(ProductHasInvoiceRequest $request)
    {
        $data = new ProductHasInvoiceDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $request->input('invoice_id'),
        );

        $this->service->saveIncomingProducts($data);
    }
}
