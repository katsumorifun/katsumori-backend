<?php

namespace App\Repositories;

use App\Contracts\Repository\HistoryRepository;
use App\Models\History;

class HistoryEquivalentRepository extends RepositoryEquivalent implements HistoryRepository
{
    public function __construct()
    {
        $this->model = History::class;
    }

    public function reject(int $id, int $moderator_id): bool
    {
        $item = $this->getBuilder()
            ->find($id);

        if (! $item) {
            return false;
        }

        return $item->fill(['moderator_id' => $moderator_id, 'rejected' => true])
            ->update();
    }
}
