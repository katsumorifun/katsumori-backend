<?php

namespace App\Contracts\Auth;

use App\Exceptions\AuthException;

interface Auth
{
    /**
     * Попытка авторизаваться.
     *
     * @throws AuthException
     */
    public function attempt(string $email, string $password): array;

    /**
     * Обновлление токена доступа.
     *
     * @throws AuthException
     */
    public function updateAccessToken(string $refreshToken): array;

    /**
     * Отзыв токенов.
     *
     * @throws AuthException
     */
    public function revokeTokens(string $token_id);
}
