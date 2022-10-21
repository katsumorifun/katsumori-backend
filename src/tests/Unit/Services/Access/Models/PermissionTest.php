<?php

namespace Tests\Unit\Services\Access\Models;

use App\Services\Access\AccessException;
use App\Services\Access\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * @throws AccessException
     */
    public function test_instance()
    {
        $permission = Permission::instance('test.permission');

        $this->assertIsObject($permission);
    }

    public function test_instance_with_empty_name()
    {
        $this->expectException(AccessException::class);
        Permission::instance('');
    }
}
