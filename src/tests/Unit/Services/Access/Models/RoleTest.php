<?php

namespace Tests\Unit\Services\Access\Models;

use App\Services\Access\AccessException;
use App\Services\Access\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * @throws \App\Services\Access\AccessException
     */
    public function test_instance()
    {
        $role_data = [
            'id' => 1,
            'name_en' => 'en',
            'name_ru' => 'ru',
            'permissions' => [

            ]
        ];

        $role = Role::instance($role_data);

        $this->assertIsObject($role);
    }

    public function test_instance_with_empty_data()
    {
        $this->expectException(AccessException::class);

        Role::instance([]);
    }
}
