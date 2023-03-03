<?php

namespace App\Http\Controllers;

use App\Dto\InvoiceDto;
use App\Http\Requests\InvoiceRequest;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
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

        return view('user/invoices', compact('invoices'));
    }

    /**
     * @param InvoiceRequest $request
     * @return JsonResponse
     */
    public function store(InvoiceRequest $request): JsonResponse
    {
        $request->validated();

        $data = new InvoiceDto(
            $request->input('number'),
            $request->input('date'),
            $request->input('from'),
            $request->input('to'),
            $request->input('provider_id'),
            $request->input('customer_id'),
            $request->input('type_id'),
            $request->input('status_id'),
        );

        $result = $this->service->create($data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $invoice = $this->service->read($id);

        return view('user/invoice-profile', compact('invoice'));
    }

    /**
     * @param int $id
     * @param InvoiceRequest $request
     * @return JsonResponse
     */
    public function update(int $id, InvoiceRequest $request): JsonResponse
    {
        $request->validated();

        $data = new InvoiceDto(
            $request->input('number'),
            $request->input('date'),
            $request->input('from'),
            $request->input('to'),
            $request->input('provider_id'),
            $request->input('customer_id'),
            $request->input('type_id'),
            $request->input('status_id'),
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
