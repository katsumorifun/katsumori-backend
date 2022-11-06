<?php

namespace App\Repositories;

use App\Base\Filter\FilterDTO;
use App\Contracts\Repository\AnimeRepository;
use App\Models\Anime as AnimeModel;
use Illuminate\Contracts\Database\Query\Builder;

class AnimeEquivalentRepository extends RepositoryEquivalent implements AnimeRepository
{
    public function __construct()
    {
        $this->model = AnimeModel::class;
    }

    /**
     * Метод возвращает список тайтлов + студии, наличие лицензий, жанры, темы и продюсеров (таблица staff).
     *
     * @param  FilterDTO  $search
     * @param  int  $perPage
     * @param  int  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListAndGeneralInfoPaginate(FilterDTO $search, int $perPage = 12, int $page = 1)
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

        foreach ($search->fields as $name => $params) {
           $builder = $builder->where($name, $params);
        }

        if (! empty($search->order)) {
            $builder = $builder->orderBy($search->order);
        }

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }

    public function getItemWithRelations($id)
    {
        return $this->getBuilder()
            ->with(['studios', 'licensors', 'genres', 'themes', 'characters'])
            ->where('approved', true)
            ->with('staff', function (Builder $query) {
                $query
                    ->select(['id', 'mal_id', 'name_jp', 'name_en', 'name_ru', 'image_x32', 'image_x64', 'image_original']);
            })
            ->find($id);
    }

    public function getChangesHistoryList($id)
    {
        return $this->getBuilder()
            ->find($id, ['id'])
            ->histories
            ->where('type', 'history');
    }

    public function getModerationList(int $id, ?int $user_id = null)
    {
        $items = $this->getBuilder()
            ->find($id, ['id'])
            ->histories()
            ->orderBy('updated_at', 'desc')
            ->where('type', 'moderation');

        if (is_null($user_id)) {
            return $items->get();
        }

        return $items->where('user_id', $user_id)->get();
    }
}
