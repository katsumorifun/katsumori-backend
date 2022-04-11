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
}
