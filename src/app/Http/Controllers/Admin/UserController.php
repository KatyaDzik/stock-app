<?php

namespace App\Http\Controllers\Admin;

use App\Dto\PermissionsToUpdateDto;
use App\Dto\UserDto;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController
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
     * @return View
     */
    public function getAll(): View
    {
        $users = $this->service->getAll();

        return view('admin/main-admin-panel', compact('users'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $user = $this->service->read($id);

        return view('admin/user-profile', compact('user'));
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
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function changePermissions(int $id, Request $request): JsonResponse
    {
        $dto = new PermissionsToUpdateDto($request->input('permissions'));
        $this->service->updatePermissions($id, $dto);

        return response()->json('updated');
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function create(UserRequest $request): JsonResponse
    {
        $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('login'),
            $request->input('role_id'),
            $request->input('password')
        );

        $result = $this->service->create($data);

        return response()->json($result);
    }
}
