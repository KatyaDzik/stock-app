<?php

namespace App\Services\PostServiceInterface;

use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
    public function login(array $data): JsonResponse;
}
