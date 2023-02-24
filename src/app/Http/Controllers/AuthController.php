<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
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
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function register(UserRequest $request): JsonResponse
    {
        $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('login'),
            $request->input('role_id'),
            $request->input('password')
        );

        $result = $this->service->register($data);

        return response()->json($result);
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
