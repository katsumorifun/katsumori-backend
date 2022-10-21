<?php

namespace Tests\Unit\Services\Access\Models;

use App\Services\Access\AccessException;
use App\Services\Access\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public array $role = [];

    /**
     * @throws \App\Services\Access\AccessException
     */
    public function test_instance()
    {
        $role = Role::instance($this->role);

        $this->assertIsObject($role);
    }

    public function test_instance_with_empty_data()
    {
        $this->expectException(AccessException::class);

        Role::instance([]);
    }

    public function test_to_array()
    {
        $role = Role::instance($this->role);

        $this->assertEquals($role->getToArray(), [
            'id' => $this->role['id'],
            'name_en' => $this->role['name_en'],
            'name_ru' => $this->role['name_ru'],
            'permissions' => $this->role['permissions']
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = [
            'id' => 1,
            'name_en' => 'en',
            'name_ru' => 'ru',
            'permissions' => [
                'test.permission'
            ]
        ];
    }
}
