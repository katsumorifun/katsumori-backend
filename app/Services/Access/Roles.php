<?php

namespace App\Services\Access;

use App\Contracts\Access\Roles as RolesContract;
use App\Services\Access\Models\Permission;
use App\Services\Access\Models\Role;
use App\Support\Enums\Group;

class Roles implements RolesContract
{
    /**
     * @var array [App\Services\Access\Models\Permission, ...]
     */
    private array $roles;

    public function __construct(array $data)
    {
        $this->roles = $data;
    }

    /**
     * @throws AccessException
     */
    public function checkPermission(Group $role_id, string $permission): bool
    {
        $permission = Permission::instance($permission);

        return in_array($permission, $this->roles[$role_id->value]->getPermissions());
    }

    public function getRole(Group $role_id): Role
    {
        return $this->roles[$role_id->value];
    }
}
