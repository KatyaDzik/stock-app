<?php

namespace App\Http\Controllers;

use App\Dto\ProductHasInvoiceDto;
use App\Http\Requests\ProductHasInvoiceRequest;
use App\Http\Requests\ProductHasInvoiceUpdateRequest;
use App\Services\ProductHasInvoicesService;
use Illuminate\View\View;

/**
 * Class ProductsToIncomingInvoiceController
 * @package App\Http\Controllers
 */
class ProductsToIncomingInvoiceController extends Controller
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
     * @return void
     */
    public function destroy(int $invoice, int $product): void
    {
        $this->service->delete($product);
    }

    /**
     * @param int $id
     * @return View
     */
    public function getAll(int $id): View
    {
        $products = $this->service->getAllByInvoicePaginate($id, 5);

        return view('user/invoice/manage-incoming-products')->with('products', $products)->with('id', $id);
    }

    /**
     * @param ProductHasInvoiceRequest $request
     * @return void
     */
    public function store(int $invoice, ProductHasInvoiceRequest $request): void
    {
        $data = new ProductHasInvoiceDto(
            $request->input('count'),
            $request->input('price'),
            $request->input('nds'),
            $request->input('product_id'),
            $invoice
        );

        $this->service->saveIncomingProducts($data);
    }

    /**
     * @param int $invoice
     * @param int $product_id
     * @param ProductHasInvoiceUpdateRequest $request
     * @return void
     */
    public function update(int $invoice, int $product_id, ProductHasInvoiceUpdateRequest $request): void
    {
        $this->service->updateIncomingProducts($invoice, $product_id, $request->validated());
    }
}
