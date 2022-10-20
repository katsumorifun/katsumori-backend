<?php

namespace App\Services\Access\Models;

class Permission
{
    private string $name;

    public static function instance(string $name): Permission
    {
        $permission = new self();
        $permission->name = $name;

        return $permission;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
