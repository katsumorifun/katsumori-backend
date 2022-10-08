<?php

namespace App\Services\SearchService;

use App\Models\Anime;
use App\Repositories\Repository;
use Elastic\Elasticsearch\Client;

class ElasticSearch extends Repository implements Search
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function anime($query)
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch($query = '')
    {
        $model = new Anime();

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title_en', 'title_ru', 'title_jp'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }
    private function buildCollection($items)
    {
        $ids = \Arr::pluck($items['hits']['hits'], '_id');

        return Anime::whereIn('id', $ids)
            ->with('studios')
            ->with('genres')
            ->get();
    }
}
