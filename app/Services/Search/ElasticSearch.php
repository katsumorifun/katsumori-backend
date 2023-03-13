<?php

namespace App\Services\Search;

use App\Models\Anime;
use Elastic\Elasticsearch\Client;

class ElasticSearch implements Search
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
                    'wildcard' => [
                        'title_en' => [
                            'value' => '*'.$query.'*',
                            'boost' => 1,
                            'rewrite' => 'constant_score',
                            'case_insensitive' => true,
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function buildCollection($items)
    {
        return \Arr::pluck($items['hits']['hits'], '_source');
    }
}
