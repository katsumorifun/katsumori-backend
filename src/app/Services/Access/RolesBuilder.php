<?php

namespace App\Services\Access;

use App\Services\Access\Models\Role;

class RolesBuilder
{
    private array $roles = [];

    public static function create()
    {
        return new static();
    }

    /**
     * @throws AccessException
     */
    public function build(): Roles
    {
        $roles = [];

        foreach ($this->roles as $id => $role) {
            $role = $this->roles[$id];
            $role['id'] = $id;

            $roles[$id] = Role::instance($role);
        }

        return new Roles($roles);
    }

    public function setRoles(array $roles): RolesBuilder
    {
        $this->roles = $roles;
        return $this;
    }
}
