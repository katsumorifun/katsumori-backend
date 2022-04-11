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
     * @param array $where
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findBy(array $where , array $columns = ['*'])
    {
        return $this->query()->where($where)->get($columns);
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
