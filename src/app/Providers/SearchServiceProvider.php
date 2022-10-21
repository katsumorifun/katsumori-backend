<?php

namespace App\Providers;

use App\Services\Search\ElasticSearch;
use App\Services\Search\EquivalentSearch;
use App\Services\Search\Search;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Search::class, function () {
            if (! config('services.search.enabled')) {
                return new EquivalentSearch();
            }

            return new ElasticSearch(
                $this->app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.host'))
                ->setBasicAuthentication(
                    $app['config']->get('services.search.user'),
                    $app['config']->get('services.search.password')
                )
                ->build();
        });
    }
}
