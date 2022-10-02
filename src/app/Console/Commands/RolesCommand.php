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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_edit = Permission::create(['name' => 'users.edit']);
        $user_comment = Permission::create(['name' => 'users.comments']);
        $user_admin_block_comments = Permission::create(['name' => 'users.admin.block.comments']);
        $user_admin_ban = Permission::create(['name' => 'users.admin.ban']);

        $role_guest = Role::create(['id'=> User::GUEST_GROUP_ID, 'en_name' => 'guest', 'russian_name' => 'гость']);
        $role_user = Role::create(['en_name' => 'user', 'russian_name' => 'пользователь']);
        $role_admin = Role::create(['en_name' => 'administrator', 'russian_name' => 'администратор']);
        $role_anime_moder = Role::create(['en_name' => 'anime moderator', 'russian_name' => 'модератор аниме']);
        $role_manga_moder = Role::create(['en_name' => 'manga moderator', 'russian_name' => 'модератор манги']);
        $role_ranobe_moder = Role::create(['en_name' => 'ranobe moderator', 'russian_name' => 'модератор ранобэ']);
        $role_super_moder = Role::create(['en_name' => 'super moderator', 'russian_name' => 'супер модератор']);
        $role_user_moderator = Role::create(['en_name' => 'user moderator', 'russian_name' => 'модератор пользователей']);
        $role_youtuber = Role::create(['en_name' => 'Youtuber', 'russian_name' => 'ютубер']);

        $role_guest->permissions()->attach($user_edit);

        $role_user->permissions()->sync($user_edit);
        $role_user->permissions()->attach($user_comment);

        $role_admin->permissions()->attach($user_admin_block_comments);
        $role_admin->permissions()->attach($user_admin_ban);

        $role_super_moder->permissions()->attach($user_admin_block_comments);
        $role_super_moder->permissions()->attach($user_admin_ban);

        $role_user_moderator->permissions()->attach($user_admin_block_comments);
        $role_user_moderator->permissions()->attach($user_admin_ban);
    }
}
