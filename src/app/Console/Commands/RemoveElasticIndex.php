<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Console\Command;

class RemoveElasticIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove indices Elasticsearch';

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
            $this->elasticsearch->indices()->delete([
                'index' => 'anime',
            ]);

        } catch (ClientResponseException|ServerResponseException|MissingParameterException $e) {

            $this->error($e->getMessage());
        }

        $this->info('Done!');
    }
}
