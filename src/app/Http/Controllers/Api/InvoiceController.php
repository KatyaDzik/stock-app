<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $invoices = $this->service->getAll();

        return response()->json(compact('invoices'));
    }

    /**
     * @param InvoiceRequest $request
     * @return JsonResponse
     */
    public function store(InvoiceRequest $request): JsonResponse
    {
        $this->service->create($request->validated());

        return response()->json(['message' => 'created successfully']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $invoice = $this->service->read($id);

        return response()->json($invoice);
    }

    /**
     * @param int $id
     * @param InvoiceUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, InvoiceUpdateRequest $request): JsonResponse
    {
        $this->service->update($id, $request->validated());

        return response()->json(['message' => 'updated successfully']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'deleted successfully']);
    }
}
