<?php

namespace App\Contracts\Repository;

use App\Base\Filter\AnimeFilterDTO;

interface AnimeRepository
{
    /**
     * Метод возвращает список тайтлов + студии, наличие лицензий, жанры, темы и продюсеров.
     *
     * @param  AnimeFilterDTO  $filter
     * @param  int  $perPage
     * @param  int  $page
     */
    public function getListAndGeneralInfoPaginate(AnimeFilterDTO $filter, int $perPage = 12, int $page = 1);

    public function getItemWithRelations($id);

    public function getChangesHistoryList($id);

    public function getModerationList(int $id, ?int $user_id = null);

    public function getUserList(int $user_id, AnimeFilterDTO|null $filter, null|string $status = null);
}
