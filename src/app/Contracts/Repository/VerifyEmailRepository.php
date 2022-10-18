<?php

namespace App\Contracts\Repository;

interface VerifyEmailRepository
{
    public function createHash(int $user_id, string $hash);

    public function getHash(int $user_id, string $hash);

    public function removeOldHash(int $days = 1);
}
