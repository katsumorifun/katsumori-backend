<?php

namespace App\Contracts\Repository;

use App\Base\Filter\FilterDTO;

interface AnimeRepository
{
    /**
     * Метод возвращает список тайтлов + студии, наличие лицензий, жанры, темы и продюсеров.
     *
     * @param  FilterDTO  $search
     * @param  int  $perPage
     * @param  int  $page
     */
    public function getListAndGeneralInfoPaginate(FilterDTO $search, int $perPage = 12, int $page = 1);

    public function getItemWithRelations($id);

    public function getChangesHistoryList($id);

    public function getModerationList($id);
}
