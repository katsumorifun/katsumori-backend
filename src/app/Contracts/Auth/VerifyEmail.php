<?php

namespace App\Contracts\Auth;

interface VerifyEmail
{
    /**
     * Отправка сообщения на почту
     */
    public function send(int $user_id, string $user_name);

    /**
     * Подтверждение почты
     */
    public function verifyEmail(int $user_id, string $hash);
}
