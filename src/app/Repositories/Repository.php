<?php

namespace App\Repositories;

class Repository
{
    /**
     * Eloquent model.
     *
     * @var string $model model class eloquent
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
     * @param array $columns
     * @param bool $paginate
     * @param int $per_page
     * @param int $page
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
     * @param string|array $column
     * @param null $operator
     * @param null $value
     * @param array $columns
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
     * @param int $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findById(int $id , array $columns = ['*'])
    {
        return $this
            ->query()
            ->find($id, $columns);
    }

    /**
     * Обновление информации по id записи
     *
     * @param int $id
     * @param array $data
     * @param array $allowData данные которые разрешено редактировать
     * @param array $columns
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function update(int $id, array $data = [], array $allowData = [], array $columns = ['*'])
    {
        $item = $this
            ->query()
            ->find($id, $columns);

        if (empty($item)) {
            return false;
        }

        $allow = [];

        foreach ($allowData as $name) {
            $allow[$name] = '';
        }

        $data = array_intersect_key($data, $allow);
        $item->update(array_diff($data, array('', ' ')));

        return $item;

    }

    /**
     * Обновление информации по id записи без сохранения в базу данных
     *
     * @param int $id
     * @param array $data
     * @param array $allowData
     * @param array $columns
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateWithoutSaving(int $id, array $data = [], array $allowData = [], array $columns = ['*']): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|bool|\Illuminate\Database\Eloquent\Builder|array
    {
        $item = $this
            ->query()
            ->find($id, $columns);

        if (empty($item)) {
            return false;
        }

        $allow = [];

        foreach ($allowData as $name) {
            $allow[$name] = '';
        }

        $data = array_intersect_key($data, $allow);
        $item->fill(array_diff($data, array('', ' ')));

        return $item;
    }

}
