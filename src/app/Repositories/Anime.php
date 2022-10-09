<?php

namespace App\Repositories;

use App\Base\Filter\FilterDTO;
use App\Models\Anime as AnimeModel;
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
     * @param int $page
     * @param array $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListAndGeneralInfoPaginate(int $perPage = 12, int $page = 1, FilterDTO $search)
    {

        $builder = $this->getBuilder()
            ->with(['studios', 'licensors', 'genres', 'themes'])
            ->where('approved', true)
            ->with('staff', function (Builder $query) {
                $query
                    ->select(['id', 'mal_id', 'name_jp', 'name_en', 'name_ru', 'image_x32', 'image_x64', 'image_original'])
                    ->where('position', 'producer');
            });

        foreach ($search->relations as $name => $ids) {
            $builder = $builder->$name($ids);
        }

        foreach ($search->fields as $name => $param) {
           $builder = $builder->where($name, $param);
        }

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }

}
