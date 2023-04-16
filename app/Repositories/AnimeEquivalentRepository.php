<?php

namespace App\Repositories;

use App\Base\Filter\AnimeFilterDTO;
use App\Contracts\Repository\AnimeRepository;
use App\Exceptions\OperationError;
use App\Models\Anime as AnimeModel;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;

class AnimeEquivalentRepository extends RepositoryEquivalent implements AnimeRepository
{
    public function __construct()
    {
        $this->model = AnimeModel::class;
    }

    protected function animeFilter(AnimeFilterDTO|null $search, Builder $builder): Builder
    {
        foreach ($search->relations as $name => $ids) {
            $builder = $builder->$name($ids);
        }

        foreach ($search->fields as $name => $params) {
            $notIn = [];
            $in = [];

            foreach ($params as $key => $param) {
                if ($param['operator'] === '=') {
                    $in[] = $param['name'];
                } else {
                    $notIn[] = $param['name'];
                }
            }

            if (! empty($in)) {
                $builder = $builder->whereIn($name, $in);
            }
            if (! empty($notIn)) {
                $builder = $builder->whereNotIn($name, $notIn);
            }

        }

        if (! empty($search->order)) {
            $builder = $builder->orderBy($search->order);
        }

        return $builder;
    }

    /**
     * Метод возвращает список тайтлов + студии, наличие лицензий, жанры, темы и продюсеров (таблица staff).
     *
     * @param AnimeFilterDTO|null $filter
     * @param int $perPage
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListAndGeneralInfoPaginate(AnimeFilterDTO|null $filter, int $perPage = 12, int $page = 1): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        $builder = $this->getBuilder()
            ->with(['studios', 'licensors', 'genres', 'themes'])
            ->where('approved', true)
            ->with('staff', function (Builder $query) {
                $query
                    ->select(['id', 'mal_id', 'name_jp', 'name_en', 'name_ru', 'image_x32', 'image_x64', 'image_original'])
                    ->where('position', 'producer');
            });

        if(! is_null($filter)) {
            $builder = $this->animeFilter($filter, $builder);
        }

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Метод возвращает список тайтлов со всеми связями.
     *
     * @param int $id
     */
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
        // @phpstan-ignore-next-line
        return $this->getBuilder()
            ->find($id, ['id'])
            ->histories()
            ->where('type', 'history');
    }

    public function getModerationList(int $id, ?int $user_id = null)
    {
        // @phpstan-ignore-next-line
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

    /**
     * @throws OperationError
     */
    public function getUserList(int $user_id, AnimeFilterDTO|null $filter, null|string $status = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = User::find($user_id);

        if (empty($query)) {
            throw new OperationError('user not found', 404, 'user');
        }

        $query = $query->anime()
            ->with(['studios', 'licensors', 'genres', 'themes'])
            ->where('approved', true)
            ->with('staff', function (Builder $query) {
                $query
                    ->select(['id', 'mal_id', 'name_jp', 'name_en', 'name_ru', 'image_x32', 'image_x64', 'image_original'])
                    ->where('position', 'producer');
            })
            ->selectRaw('anime.*, anime_user.status AS list_status');

        if(! is_null($filter)) {
            $query = $this->animeFilter($filter, $query);
        }

        if (! is_null($status)) {
            $query->where('anime_user.status', $status);
        }

        return $query->paginate();
    }
}
