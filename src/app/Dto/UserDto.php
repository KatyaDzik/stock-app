<?php

namespace App\Dto;

class UserDto
{
    private $name;
    private $role_id;
    private $password;

    public function __construct(string $name, int $role_id, string $password)
    {
        $this->name = $name;
        $this->role_id = $role_id;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role_id;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
