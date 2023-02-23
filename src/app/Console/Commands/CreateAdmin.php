<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {group_id} {email} {name} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $user = new User();

        try {
            $user->create([
                'name'          => $this->argument('name'),
                'email'         => $this->argument('email'),
                'password'      => bcrypt($this->argument('password')),
                'group_id'      => $this->argument('group_id'),
            ]);
        } catch (QueryException $exception) {

            if ($exception->getCode() === '23000') {
                $this->info('User already exists: '.$exception->errorInfo[2]);
            } else {
                $this->info($exception);
            }
        }

        return Command::SUCCESS;
    }
}
