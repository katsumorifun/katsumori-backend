<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GuardServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Guard\AuthThrottle::class, \App\Services\Guard\AuthThrottle::class);
        $this->app->singleton(\App\Contracts\Guard\AuthThrottle::class, \App\Services\Guard\AuthThrottle::class);
        $this->app->alias(\App\Contracts\Guard\AuthThrottle::class, 'app.auth_throttle');
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

    public function provides()
    {
        return [
            'app.guard.auth_throttle',
            'App\Contracts\Guard\AuthThrottle',
        ];
    }
}
