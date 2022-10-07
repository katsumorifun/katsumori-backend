<?php

namespace App\Repositories;

use \App\Models\Anime as AnimeModel;
use Illuminate\Contracts\Database\Query\Builder;

class Anime extends Repository
{
    public function __construct()
    {
        $this->model = AnimeModel::class;
    }

    /**
     * Метод возвращает список тайтлов + студии, наличие лицензий, жанры, темы и продюсеров (таблица staff)
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListAndGeneralInfoPaginate(int $perPage = 12, $page = 1)
    {
        return $this->getBuilder()
            ->with('studios')
            ->with('licensors')
            ->with('genres')
            ->with('themes')
            ->with('staff', function (Builder $query) {
                $query
                    ->select(['id', 'mal_id', 'name_jp', 'name_en', 'name_ru', 'image_x32', 'image_x64', 'image_original'])
                    ->where('position', 'producer');
            })
            ->paginate($perPage, ['*'], 'page', $page);
    }

}
