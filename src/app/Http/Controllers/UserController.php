<?php

namespace App\Http\Controllers;

use App\Dto\UserDto;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('login'),
            $request->input('role_id'),
            $request->input('password')
        );

        $result = $this->service->update($id, $data);

        return response()->json($result);
    }
}
