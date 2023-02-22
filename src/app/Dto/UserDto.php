<?php

namespace App\Dto;

class UserDto
{
    private string $name;
    private string $login;
    private int $role_id;
    private string $password;

    public function __construct(string $name, string $login, int $role_id, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->role_id = $role_id;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getRole(): int
    {
        return $this->role_id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
