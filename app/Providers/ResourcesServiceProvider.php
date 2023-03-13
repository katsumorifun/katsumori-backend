<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{
    /**
     * Register any resources services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Resources\Images\Factory\ImageFactory::class, \App\Base\Resources\Images\Factory\ImageFactory::class);
        $this->app->singleton(\App\Contracts\Resources\Images\Factory\ImageFactory::class, \App\Base\Resources\Images\Factory\ImageFactory::class);
    }

    /**
     * Bootstrap any resources services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
