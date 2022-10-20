<?php

namespace App\Support\Facades;

use App\Contracts\Access\Roles;
use App\Services\Access\Models\Role;
use App\Support\Enums\Group;
use Illuminate\Support\Facades\Facade;
/**
 * @method static \App\Contracts\Access\Roles checkPermission(Group $role_id, string $permission): bool;
 * @method static \App\Contracts\Access\Roles getRole(Group $role_id): Role
 *
 * @see \Illuminate\Contracts\Auth\Access\Gate
 */
class Access extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Roles::class;
    }
}
