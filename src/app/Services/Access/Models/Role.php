<?php

namespace App\Services\Access\Models;

class Role
{
    private int $id;
    private string $name_en;
    private string $name_ru;
    private array $permissions;

    public function instance(array $data): Role
    {
        $role = new self();
        $role->id = $data['id'];
        $role->name_en = $data['name_en'];
        $role->name_ru = $data['name_ru'];

        foreach ($data['permissions'] as $permission) {
            $role->permissions[] = Permission::instance($permission);
        }

        return $role;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameEn(): string
    {
        return $this->name_en;
    }

    /**
     * @return string
     */
    public function getNameRu(): string
    {
        return $this->name_ru;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

}
