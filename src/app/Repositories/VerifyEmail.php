<?php

namespace App\Repositories;
use App\Models\VerifyEmail as VerifyEmailModel;

class VerifyEmail extends Repository
{
    public function __construct()
    {
        $this->model = VerifyEmailModel::class;
    }

    public function create(int $user_id, string $hash)
    {
        $this->getBuilder()->create([
                'user_id' => $user_id,
                'hash'    => $hash,
        ]);
    }

    public function getHashAndUser(int $user_id, string $hash)
    {
//        return $this->getBuilder()->join('users', 'users.id', '=', 'user_id')
//          ->select('verify_emails.*', 'users.name', 'users.id', 'users.email_verified_at')
//          ->firstWhere([
//              'user_id' => $user_id,
//              'verify_emails.hash'    => $hash,
//          ]);

        return $this->getBuilder()->firstWhere([
              'user_id' => $user_id,
              'verify_emails.hash'    => $hash,
          ]);
    }
}
