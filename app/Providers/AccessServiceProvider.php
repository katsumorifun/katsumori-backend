<?php

namespace App\Providers;

use App\Contracts\Access\Roles;
use App\Services\Access\RolesBuilder;
use App\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Register any access services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Roles::class, function ($app) {
            return RolesBuilder::create()
                ->setRoles($app['config']->get('roles'))
                ->build();
        });
    }

    /**
     * Bootstrap any access services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
