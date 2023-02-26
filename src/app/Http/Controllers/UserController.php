<?php

namespace App\Http\Controllers;

use App\Dto\PermissionsToUpdateDto;
use App\Dto\UserDto;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): View
    {
        $user = $this->service->read($id);

        return view('admin/user-profile', compact('user'));
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

        return response()->json($result, 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('deleted', 200);
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $users = $this->service->getAll();

        return view('admin/main-admin-panel', compact('users'));
    }

    public function changePermissions(int $id, Request $request): JsonResponse
    {
        $dto = new PermissionsToUpdateDto($request->input('permissions'));
        $this->service->updatePermissions($id, $dto);

        return response()->json('updated');
    }
}
