<?php

namespace App\Contracts\Auth;

use App\Exceptions\OperationError;

interface Auth
{
    /**
     * Попытка авторизаваться.
     *
     * @throws OperationError
     */
    public function attempt(string $email, string $password);

    /**
     * @throws OperationError
     */
    public function login(string $email, string $password);

    public function getData(): array;

    public function updateAccessToken(string $refreshToken);

    public function revokeTokens(string $token_id);
}
