<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class RolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create users roles and permissions';

    private $userModel = User::class;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->create();
    }

    public function create()
    {
        $roles = [
            [
                'id' => $this->userModel::GUEST_GROUP_ID,
                'en_name' => 'guest',
                'russian_name' => 'гость',
                'permissions' => [
                    'users.edit',
                ]
            ],
            [
                'id' => $this->userModel::USER_GROUP_ID,
                'en_name' => 'user',
                'russian_name' => 'поьзователь',
                'permissions' => [
                    'users.edit',
                    'users.comments',

                ]
            ],
            [
                'id' => $this->userModel::ADMIN_GROUP_ID,
                'en_name' => 'administrator',
                'russian_name' => 'администратор',
                'permissions' => [
                    'users.edit',
                    'users.comments',
                    'users.admin.block.comments',
                    'users.admin.ban',
                    'users.admin.edit',
                    'anime.update',
                    'anime.moderation',
                    'anime.create',

                ]
            ],
            [
                'id' => $this->userModel::ANIME_MODER_GROUP_ID,
                'en_name' => 'anime moderator',
                'russian_name' => 'модератор аниме раздела',
                'permissions' => [
                    'users.edit',
                    'users.comments',
                    'anime.update',
                    'anime.moderation',
                    'anime.create',

                ]
            ],
            [
                'id' => $this->userModel::MANGA_MODER_GROUP_ID,
                'en_name' => 'manga moderator',
                'russian_name' => 'модератор раздела манги',
                'permissions' => [
                    'users.edit',
                    'users.comments',

                ]
            ],
            [
                'id' => $this->userModel::RANOBE_MODER_GROUP_ID,
                'en_name' => 'light novel moderator',
                'russian_name' => 'модератор раздела ранобэ',
                'permissions' => [
                    'users.edit',
                    'users.comments',

                ]
            ],
            [
                'id' => $this->userModel::SUPER_MODER_GROUP_ID,
                'en_name' => 'super moder',
                'russian_name' => 'супер модератор',
                'permissions' => [
                    'users.edit',
                    'users.comments',
                    'users.admin.block.comments',
                    'users.admin.ban',
                    'users.admin.edit',
                    'anime.update',
                    'anime.moderation',
                    'anime.create',

                ]
            ],
            [
                'id' => $this->userModel::USER_MODER_GROUP_ID,
                'en_name' => 'users moder',
                'russian_name' => 'модератор пользователей',
                'permissions' => [
                    'users.edit',
                    'users.comments',
                    'users.admin.block.comments',
                    'users.admin.ban',
                    'users.admin.edit',

                ]
            ],
            [
                'id' => $this->userModel::STEAMER_GROUP_ID,
                'en_name' => 'blogger',
                'russian_name' => 'блоггер',
                'permissions' => [
                    'users.edit',
                    'users.comments',

                ]
            ],
        ];


        foreach ($roles as $role_item) {

            $role = Role::create([
                'id'           => $role_item['id'],
                'en_name'      => $role_item['en_name'],
                'russian_name' => $role_item['russian_name']
            ]);

            foreach ($role_item['permissions'] as $permission_item) {

                $permission = Permission::where('name', $permission_item)->get();

                if($permission->count() == 0){
                    $permission = Permission::create(['name' => $permission_item]);
                }

                $role->permissions()->attach($permission);

            }
        }
    }
}
