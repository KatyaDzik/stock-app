<?php

namespace App\Http\Controllers\Admin;

use App\Dto\PermissionsToUpdateDto;
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
}
