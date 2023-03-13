<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;

class RepositoryEquivalent
{
    /**
     * Eloquent model.
     *
     * @var string model class eloquent
     */
    protected string $model;

    protected function query(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model::query();
    }

    public function getBuilder(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->query();
    }

    /**
     * @param  array  $columns
     * @param  bool  $paginate
     * @param  int  $per_page
     * @param  int  $page
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|array
     */
    public function getList(array $columns = ['*'], bool $paginate = false, int $page = 1, int $per_page = 6): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|array
    {
        if ($paginate)
        {
            return $this
                ->query()
                ->paginate($per_page, $columns, 'page', $page);
        }

        return $this
            ->query()
            ->get();
    }

    /**
     * @param  string|array  $column
     * @param  null  $operator
     * @param  null  $value
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findBy(string|array $column, $operator = null, $value = null, array $columns = ['*'])
    {
        return $this
            ->query()
            ->where($column, $operator, $value)
            ->get();
    }

    /**
     * @param  int  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findById(int $id, array $columns = ['*'])
    {
        return $this
            ->query()
            ->find($id, $columns);
    }

    /**
     * Обновление информации по id записи.
     *
     * @param  int  $id
     * @param  array  $data ['field' => 'value', ...], для связей нужно перечислить id через запятую, пример: {'studios' => '1,2,3'}
     * @param  array  $columns
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     *
     * @throws \Doctrine\DBAL\Query\QueryException
     */
    public function update(int $id, array $data = [], array $columns = ['*'])
    {
        $item = $this
            ->query()
            ->withAll()
            ->find($id, $columns);

        if (empty($item)) {
            return false;
        }

        $relations = array_diff_assoc($data, $item->getRelations());

        foreach ($relations as $relation => $ids) {

            if (! empty($relation) && in_array($relation, $item->getRelations())) {

                try {
                    $item->$relation()->attach(explode(',', $ids));

                } catch (QueryException $ex) {

                    if ($ex->getCode() != 23000) {
                        throw new \Doctrine\DBAL\Query\QueryException($ex->getMessage(), $ex->getCode(), $ex->getPrevious());
                    }
                }
            }
        }

        $item->update(array_diff_assoc($data, ['', ' ']));

        return $item;

    }

    /**
     * Обновление информации по id записи без сохранения в базу данных.
     *
     * @param  int  $id
     * @param  array  $data ['field' => 'value', ...]
     * @param  array  $columns
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateWithoutSaving(int $id, array $data = [], array $columns = ['*']): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|bool|\Illuminate\Database\Eloquent\Builder|array
    {
        $item = $this
            ->query()
            ->find($id, $columns);

        if (empty($item)) {
            return false;
        }

        $item->fill(array_diff($data, ['', ' ']));

        return $item;
    }

    /**
     * Создание новой записи.
     *
     * @param  array  $data ['field' => 'value', ...]
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
     *
     * @throws \Exception
     */
    public function create(array $data = []): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return $this->query()->create(array_diff($data, ['', ' ']));
    }
}
