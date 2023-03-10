<?php

namespace App\Dto;

class UserDto
{
    private string $name;
    private string $login;
    private int $role_id;
    private string $password;

    /**
     * @param string $name
     * @param string $login
     * @param int $role_id
     * @param string $password
     */
    public function __construct(string $name, string $login, int $role_id, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->role_id = $role_id;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role_id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
