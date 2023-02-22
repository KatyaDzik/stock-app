<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private $service;

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
     * @throws \Exception
     */
    public function register(UserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('login'),
            $request->input('role_id'),
            $request->input('password')
        );

        try {
            $user = $this->service->register($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json('registration completed successfully', 200);
    }


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = new LoginDto(
            $request->input('login'),
            $request->input('password')
        );

        $result = $this->service->login($data);

        return $result;
    }


    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->user()->currentAccessToken()->delete();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json(['message' => 'Успешный выход']);
    }
}
