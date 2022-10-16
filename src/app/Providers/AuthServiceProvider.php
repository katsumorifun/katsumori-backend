<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Laravel Passport.
         */
        if (! $this->app->routesAreCached())
        {
            Passport::routes();
        }

        if (config('app.env') == 'production')
        {
            Passport::hashClientSecrets();
        }

        Passport::tokensExpireIn(now()->addHours(4));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        $this->app->singleton(\App\Contracts\Auth\Auth::class, \App\Services\Auth\Auth::class);
        $this->app->alias(\App\Contracts\Auth\Auth::class, 'app.auth');

        $this->app->singleton(\App\Contracts\Auth\VerifyEmail::class, \App\Services\Auth\VerifyEmail::class);
        $this->app->alias(\App\Contracts\Auth\VerifyEmail::class, 'app.auth.email');
    }
}
