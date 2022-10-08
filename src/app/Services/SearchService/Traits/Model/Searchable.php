<?php

namespace App\Services\SearchService\Traits\Model;

use App\Observers\ElasticObserver;

trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticObserver::class);
        }
    }
    public function getSearchIndex()
    {
        return $this->getTable();
    }
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }
    public function toSearchArray(array $fields = [])
    {
        if (!empty($fields)) {
            $fieldsArray = [];

            foreach ($fields as $item) {
                $fieldsArray[$item] = '';
            }

            return array_intersect_key($this->toArray(), $fieldsArray);
        }
        return $this->toArray();
    }
}
