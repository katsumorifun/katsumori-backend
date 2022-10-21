<?php

namespace Tests\Unit\Services\Access;

use App\Models\User;
use App\Services\Access\Models\Role;
use App\Services\Access\Roles;
use App\Services\Access\RolesBuilder;
use PHPUnit\Framework\TestCase;

class RolesBuilderTest extends TestCase
{
    public array $roles;

    /**
     * @throws \App\Services\Access\AccessException
     */
    public function test_build_empty()
    {
        $roles = RolesBuilder::create()
            ->build();

        $empty_roles = new Roles([]);

        $this->assertEquals($roles, $empty_roles);
    }

    /**
     * @throws \App\Services\Access\AccessException
     */
    public function test_set_roles()
    {
        $roles_builder = RolesBuilder::create()
            ->setRoles($this->roles)
            ->build();

        $roles = [];

        foreach ($this->roles as $id => $role) {
            $role = $this->roles[$id];
            $role['id'] = $id;

            $roles[$id] = Role::instance($role);
        }

        $roles = new Roles($roles);

        $this->assertIsObject($roles_builder);
        $this->assertEquals($roles_builder, $roles);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->roles = [
            User::GUEST_GROUP_ID => array(
                'name_en' => 'guest',
                'name_ru' => 'гость',
                'permissions' => array(
                    'users.edit',
                )
            ),
            User::USER_GROUP_ID => array(
                'name_en' => 'user',
                'name_ru' => 'поьзователь',
                'permissions' => array(
                    'users.edit',
                    'users.comments',

                )
            ),
        ];
    }
}
