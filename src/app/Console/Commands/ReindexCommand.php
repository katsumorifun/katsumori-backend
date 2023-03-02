<?php

namespace App\Console\Commands;

use App\Models\Anime;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    private Client $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->anime();
        } catch (ClientResponseException|ServerResponseException $e) {

            $this->info('server is not available');
        } catch (MissingParameterException $e) {

            $this->info('Done!');
        }

        $this->info('Done!');
    }

    /**
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     */
    public function anime()
    {
        $this->elasticsearch->indices()->deleteIndexTemplate(['anime']);

        $this->info('Indexing all anime. This might take a while...');

        $properties = Anime::$elasticProperties;

        $this->elasticsearch->indices()->create([
            'index' => 'anime',
            'body' => [
                'settings' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 2
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => $properties
                ]
            ],
        ]);

        foreach (Anime::cursor() as $item)
        {
            $this->elasticsearch->index([
                'index' => $item->getSearchIndex(),
                'type' => $item->getSearchType(),
                'id' => $item->getKey(),
                'body' => $item->toSearchArray(),
            ]);
            $this->output->write('indexed title: '.$item->title_jp);
            $this->info('-anime indexed-');
        }
    }
}
