<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Repositories\UserRepository;

class AuthService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(UserDto $data)
    {
        $result = $this->repository->save($data);

        return $result;
    }

}
