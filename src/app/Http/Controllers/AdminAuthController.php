<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Http\Requests\AdminLoginRequest;
use App\Services\AdminAuthService;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AdminAuthController extends Controller
{
    private AdminAuthService $service;

    /**
     * @param AdminAuthService $service
     */
    public function __construct(AdminAuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AdminLoginRequest $request
     * @return JsonResponse
     */
    public function login(AdminLoginRequest $request): JsonResponse
    {
        $request->validated();

        $data = new LoginDto(
            $request->input('login'),
            $request->input('password')
        );

        $result = $this->service->login($data);

        return response()->json($result);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->service->logout();

        return response()->json($result);
    }
}
