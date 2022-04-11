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

    /**
     *
     * @param int $user_id
     * @param string $hash
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
     */
    public function getHash(int $user_id, string $hash): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return $this->getBuilder()->firstWhere([
              'user_id'            => $user_id,
              'verify_emails.hash' => $hash,
          ]);
    }

    /**
     * Удаление старых пользователей
     *
     * @param int $days
     */
    public function removeOldHash(int $days = 1)
    {
        $this->getBuilder()->where(
            'created_at', '<', now()->subDays($days)
        )->delete();
    }
}
