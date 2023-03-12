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
     * @return void
     */
    public function store(ProviderRequest $request): void
    {
        $data = new ProviderDto(
            $request->input('name'),
            auth('web')->user()->id
        );

        $this->service->create($data);
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $provider = $this->service->read($id);

        return view('user/provider-profile', compact('provider'));
    }

    /**
     * @param int $id
     * @param ProviderRequest $request
     * @return void
     */
    public function update(int $id, ProviderRequest $request): void
    {
        $data = new ProviderDto(
            $request->input('name'),
            auth('web')->user()->id
        );

        $this->service->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $providers = $this->service->getAllPaginate(5);

        return view('user/providers', compact('providers'));
    }
}
