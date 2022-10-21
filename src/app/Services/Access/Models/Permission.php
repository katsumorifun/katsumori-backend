<?php

namespace App\Services\Access\Models;

use App\Services\Access\AccessException;

class Permission
{
    private string $name;

    /**
     * @throws AccessException
     */
    public static function instance(string $name): Permission
    {
        if (empty($name)) {
            throw new AccessException('Variable "$name" must be not empty');
        }

        $permission = new self();
        $permission->name = $name;

        return $permission;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
