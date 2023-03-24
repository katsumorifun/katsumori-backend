<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PassportInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Passport install and create web client';

    public function handle()
    {
        $this->call('passport:install');

        $clientRepo = app('Laravel\Passport\ClientRepository');
        $client = $clientRepo->createPasswordGrantClient(
            null,
            config('app.name').' Password Web Grant Client',
            'http://localhost',
            'users'
        );

        $this->putEnv('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET', $client->plainSecret);
        $this->putEnv('PASSPORT_PASSWORD_GRANT_CLIENT_ID', $client->id);

        $this->info('Passport init success');
    }

    public function putEnv($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}
