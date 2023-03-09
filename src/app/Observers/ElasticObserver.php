<?php

namespace App\Observers;

use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;

class ElasticObserver
{
    protected Client $elastic;

    public function __construct(Client $elastic)
    {
        $this->elastic = $elastic;
    }

    protected function updateElastic(Model $model): void
    {
        if ($model->getSearchIndex() === 'anime') {
            $model->with(['genres', 'studios']);
        }

        $this->elastic->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function updated(Model $model): void
    {
        $this->updateElastic($model);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function saved(Model $model): void
    {
        $this->updateElastic($model);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param $model
     * @return void
     *
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function deleted($model): void
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }
}
