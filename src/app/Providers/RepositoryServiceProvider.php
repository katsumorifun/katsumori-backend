<?php

namespace App\Providers;

use App\Contracts\Repository\AnimeRepository;
use App\Contracts\Repository\UserRepository;
use App\Contracts\Repository\VerifyEmailRepository;
use App\Repositories\AnimeEquivalentRepository;
use App\Repositories\UserEquivalentRepository;
use App\Repositories\VerifyEmailEquivalentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any repository services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AnimeRepository::class, AnimeEquivalentRepository::class);
        $this->app->bind(UserRepository::class, UserEquivalentRepository::class);
        $this->app->bind(VerifyEmailRepository::class, VerifyEmailEquivalentRepository::class);
    }

    /**
     * Bootstrap any repository services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
