<?php

namespace App\Base\Schedule\User;

use App\Repositories\VerifyEmail;
use \App\Repositories\User as UserRepository;

class User
{
    /**
     * Удаление старых пользователей без подтвержденной почты
     *
     */
    public function cleanOldEmailVerify()
    {
        app(VerifyEmail::class)->removeOldHash();
        app(UserRepository::class)->removeUsersUnconfirmedEmail();
    }

    /**
     * Смена группы guest у пользователей с датой гергистрации выше days на группу user
     *
     * @param int $days
     * @return void
     */
    public function changeUserGroupToUsers(int $days = 2)
    {
        app(UserRepository::class)->changeUserGroupToUsers($days);
    }
}
