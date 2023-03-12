<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Services\InvoiceService;
use Illuminate\View\View;

/**
 * Class InvoiceController
 * @package App\Http\Controllers
 */
class InvoiceController extends Controller
{
    private InvoiceService $service;

    /**
     * @param InvoiceService $service
     */
    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $invoices = $this->service->getAllPaginate(5);

        return view('user/invoice/invoices', compact('invoices'));
    }

    /**
     * @param InvoiceRequest $request
     * @return void
     */
    public function store(InvoiceRequest $request): void
    {
        $this->service->create($request->validated());
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $invoice = $this->service->read($id);

        return view('user/invoice/invoice-profile', compact('invoice'));
    }

    /**
     * @param int $id
     * @param InvoiceUpdateRequest $request
     * @return void
     */
    public function update(int $id, InvoiceUpdateRequest $request): void
    {
        $this->service->update($id, $request->validated());
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }
}
