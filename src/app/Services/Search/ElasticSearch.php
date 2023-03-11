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
        $fields = ['title_en', 'title_ru', 'title_jp'];
        $items = $this->searchOnElasticsearch($fields, $query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(array $fields, $query = '')
    {
        $model = new Anime();

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => $fields,
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
