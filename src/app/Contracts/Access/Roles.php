<?php

namespace App\Contracts\Access;

use App\Services\Access\Models\Role;
use App\Support\Enums\Group;

interface Roles
{
    public function checkPermission(Group $role_id, string $permission): bool;

    public function getRole(Group $role_id): Role;
}
