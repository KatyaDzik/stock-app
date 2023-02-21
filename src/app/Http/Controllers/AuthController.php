<?php

namespace App\Http\Controllers;

use App\Dto\UserDto;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $service;

    public function __constructor(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('role_id'),
            $request->input('password')
        );

        try {
            $user = $this->service->register($data);
        } catch (\Exception $e) {
            throw \Exception($e->getMessage());
        }

        return response()->json('registration completed successfully', 200);
    }

    public function login()
    {

    }

    public function logout()
    {

    }
}
