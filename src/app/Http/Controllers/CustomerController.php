<?php

namespace App\Http\Controllers;

use App\Dto\CustomerDto;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController
{
    private CustomerService $service;

    /**
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        $request->validated();

        $data = new CustomerDto(
            $request->input('name'),
            auth()->user()->id()
        );

        $result = $this->service->create($data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->service->read($id);

        return response()->json($result);
    }


    /**
     * @param int $id
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function update(int $id, CustomerRequest $request): JsonResponse
    {
        $request->validated();

        $data = new CustomerDto(
            $request->input('name'),
            auth()->user()->id
        );

        $result = $this->service->update($id, $data);

        return response()->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('deleted');
    }
    
    /**
     * @return View
     */
    public function getAll(): View
    {
        $customers = $this->service->getAll();

        return view('user/customers', compact('customers'));
    }
}
