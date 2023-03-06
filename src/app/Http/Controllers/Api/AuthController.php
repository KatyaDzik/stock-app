<?php

namespace App\Http\Controllers\Api;

use App\Http\LoginDto;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController
{
    private AuthService $service;

    /**
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();

        $data = new LoginDto(
            $request->input('login'),
            $request->input('password')
        );

        $result = $this->service->loginByToken($data);

        return response()->json($result);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->service->deleteToken();

        return response()->json($result);
    }
}
