<?php

namespace App\Policies;

abstract class PolicyBase
{
    /**
     * @param $user
     * @param string $permissionName
     *
     * @return bool
     */
    public function checkPermission($user, string $permissionName): bool
    {
        if ($user->roles()->with('permissions')->whereHas('permissions', function ($permissions) use ($permissionName) {
            $permissions->whereName($permissionName);
        })->first()) {
            return true;
        }

        return false;
    }
}
