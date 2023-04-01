<?php

namespace App\Observers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Database\Eloquent\Model;

class ElasticObserver
{
    protected Client $elastic;

    public function __construct(Client $elastic)
    {
        $this->elastic = $elastic;
    }

    /**
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     */
    protected function updateElastic($model): void
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
        try {
            $this->updateElastic($model);
        } catch (ServerResponseException|MissingParameterException|ClientResponseException $e) {
            $this->logError($e);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Model $model
     * @return void
     */
    public function saved(Model $model): void
    {
        try {
            $this->updateElastic($model);
        } catch (ServerResponseException|MissingParameterException|ClientResponseException $e) {
            $this->logError($e);
        }
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
        $this->elastic->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }

    private function logError(\Exception $e): void
    {
        error_log($e.' > '.$e->getMessage(), 0, 'ElasticSearch error');
    }
}
