<?php

namespace App\Contracts\Repository;

interface HistoryRepository
{
    public function reject(int $id, int $moderator_id): bool;

    public function setStatusApproveAndGet(int $id, int $moderator_id);
}
