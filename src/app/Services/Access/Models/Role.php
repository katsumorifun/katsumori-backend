<?php

namespace App\Services\Access\Models;

use App\Services\Access\AccessException;
use JetBrains\PhpStorm\ArrayShape;

class Role
{
    private int $id;
    private string $name_en;
    private string $name_ru;
    private array $permissions;

    /**
     * @throws AccessException
     */
    public static function instance(array $data): Role
    {
        if (empty($data)) {
            throw new AccessException('Variable "$data" must be not empty');
        }

        $role = new self();
        $role->id = $data['id'];
        $role->name_en = $data['name_en'];
        $role->name_ru = $data['name_ru'];

        foreach ($data['permissions'] as $permission) {
            $role->permissions[] = Permission::instance($permission);
        }

        return $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNameEn(): string
    {
        return $this->name_en;
    }

    public function getNameRu(): string
    {
        return $this->name_ru;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    #[ArrayShape(['id' => 'int', 'name_en' => 'string', 'name_ru' => 'string', 'permissions' => 'array'])]
    public function getToArray(): array
    {
        $permissions = [];

        foreach ($this->permissions as $permission) {
            $permissions[] = $permission->getName();
        }

        return [
            'id' => $this->id,
            'name_en'     => $this->name_en,
            'name_ru'     => $this->name_ru,
            'permissions' => $permissions,
        ];
    }
}
