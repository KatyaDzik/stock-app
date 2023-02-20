<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new UserService();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only([
            'name',
            'role_id',
            'password',
            'password_confirmed'
        ]);

        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->create($data);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->service->read($id);
        if (!$user) {
            $result = [
                'status' => 500,
                'error' => 'not found'
            ];
        } else {
            $result = [
                'status' => 200,
                'data' => $user
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->only([
            'name',
            'role_id',
            'password',
            'password_confirmed'
        ]);

        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->update($data, $id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $result = ['status' => 200];

        try {
            $request['data'] = $this->service->delete($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->only([
            'name',
            'password',
        ]);

        $result = $this->service->login($data);

        return $result;
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([ 'message' => 'Успешный выход']);
    }
}
