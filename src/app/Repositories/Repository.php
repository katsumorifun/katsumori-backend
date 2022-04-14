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
     * @param string|array $column
     * @param null $operator
     * @param null $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findBy(string|array $column, $operator = null, $value = null, array $columns = ['*'])
    {
        return $this->query()->where($column, $operator, $value)->get();
    }

    /**
     * @param int $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findById(int $id , array $columns = ['*'])
    {
        return $this->query()->find($id, $columns);
    }
}
