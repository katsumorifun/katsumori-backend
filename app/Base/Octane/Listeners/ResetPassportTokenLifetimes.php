<?php

declare(strict_types=1);

namespace Spiral\RoadRunnerLaravel\Listeners;

use Laravel\Passport\Passport;

class ResetPassportTokenLifetimes implements ListenerInterface
{
    /**
     * @inheritdoc
     */
    public function handle($event): void
    {
        Passport::tokensExpireIn(now()->addMonths(6));
        Passport::refreshTokensExpireIn(now()->addMonth(12));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
