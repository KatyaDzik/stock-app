<?php

namespace App\Http\Controllers;

use App\Dto\ProviderDto;
use App\Http\Requests\ProviderRequest;
use App\Services\ProviderService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProviderController
{
    private ProviderService $service;

    /**
     * @param ProviderService $service
     */
    public function __construct(ProviderService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ProviderRequest $request
     * @return JsonResponse
     */
    public function store(ProviderRequest $request): JsonResponse
    {
        $request->validated();

        $data = new ProviderDto(
            $request->input('name'),
            auth()->user()->id()
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
        $provider = $this->service->read($id);

        return view('admin/provider-profile', compact('provider'));
    }

    /**
     * @param int $id
     * @param ProviderRequest $request
     * @return JsonResponse
     */
    public function update(int $id, ProviderRequest $request): JsonResponse
    {
        $request->validated();

        $data = new ProviderDto(
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

    public function getAll()
    {
        $providers = $this->service->getAll();

        return view('user/providers', compact('providers'));
    }
}
