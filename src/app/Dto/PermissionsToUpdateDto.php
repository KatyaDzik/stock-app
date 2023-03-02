<?php

namespace App\Dto;

/**
 * Class PermissionsToUpdateDto
 * @package App\Dto
 */
class PermissionsToUpdateDto
{
    private array $permissions;

    /**
     * @param $permissions
     */
    public function __construct($permissions)
    {
        if (!$permissions) {
            $this->permissions = [];
        } else {
            $this->permissions = $permissions;
        }
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
