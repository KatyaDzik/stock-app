<?php

namespace App\Http\Controllers;

use App\Dto\UserDto;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $service;

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
    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->service->read($id);

            if ($user) {
                $result['user'] = new UserResource($user);
            } else {
                $result = 'not found';
            }

        } catch (\Exception $e) {
            throw new \Exception('here' . $e->getMessage());
        }

        return response()->json($result, 200);
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = new UserDto(
            $request->input('name'),
            $request->input('login'),
            $request->input('role_id'),
            $request->input('password')
        );

        try {
            $user = $this->service->update($id, $data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json(['user' => new UserResource($user)], 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = $this->service->delete($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return response()->json('deleted', 200);
    }
}
