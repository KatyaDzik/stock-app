<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\LoginDto;
use App\Http\Requests\AdminLoginRequest;
use App\Services\AdminAuthService;
use App\Services\Interfaces\AdminAuthServiceInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AdminAuthController extends Controller
{
    private AdminAuthServiceInterface $service;

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
