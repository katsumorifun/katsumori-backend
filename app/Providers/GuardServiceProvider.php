<?php

namespace App\Providers;

use App\Services\Guard\AuthThrottle;
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
        $this->bindAuthThrottle();

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

    private function bindAuthThrottle()
    {
        $this->app->bind(\App\Contracts\Guard\AuthThrottle::class, function ($app) {
            $throttle = new AuthThrottle($app->request);
            $throttle->setAttemptCount(config('auth.throttle.attempt_count'));
            $throttle->setTimeOut(config('auth.throttle.time_out'));

            return $throttle;
        });
    }
}
