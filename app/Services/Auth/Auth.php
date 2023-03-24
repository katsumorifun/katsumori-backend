<?php

namespace App\Services\Auth;

use App\Contracts\Auth\Auth as AuthContract;
use App\Contracts\Guard\AuthThrottle;
use App\Exceptions\AuthException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class Auth implements AuthContract
{
    protected TokenRepository $token_repository;
    protected RefreshTokenRepository $refresh_token_repository;
    protected AuthThrottle $auth_throttle;

    public function __construct(Application $app)
    {
        $this->auth_throttle = $app->make(AuthThrottle::class);
        $this->token_repository = $app->make(TokenRepository::class);
        $this->refresh_token_repository = $app->make(RefreshTokenRepository::class);
    }

    /**
     * @throws AuthException
     */
    public function attempt(string $email, string $password): array
    {
        if(! $this->auth_throttle->check()) {
            throw new AuthException(__('auth.throttle', ['seconds' => $this->getThrottleTimeOut()]));
        }

        return $this->login($email, $password);
    }

    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws AuthException
     */
    protected function login(string $email, string $password): array
    {
        $data = [
            'grant_type'    => 'password',
            'client_id'     => config('auth.passport.password_grant_client_id'),
            'client_secret' => config('auth.passport.password_grant_client_secret'),
            'username'      => $email,
            'password'      => $password,
            'scope'         => '*',
        ];

        return $this->oauthToken($data);
    }

    /**
     * @throws AuthException
     */
    public function updateAccessToken(string $refreshToken): array
    {
        $data = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => config('auth.passport.password_grant_client_id'),
            'client_secret' => config('auth.passport.password_grant_client_secret'),
            'scope'         => '',
        ];

        return $this->oauthToken($data);
    }

    public function revokeTokens(string $token_id)
    {
        $this->token_repository->revokeAccessToken($token_id);
        $this->refresh_token_repository->revokeRefreshTokensByAccessTokenId($token_id);
    }

    private function getThrottleTimeOut(): int
    {
        return $this->auth_throttle->getTimeOut();
    }

    /**
     * @throws AuthException
     */
    protected function oauthToken(array $data): array
    {
        $response = Http::post(config('app.url').'/oauth/token', $data);

        $data = $response->json();

        if ($response->status() == 400) {
            $this->auth_throttle->addFailCount();
            throw new AuthException(__('auth.password'));
        }

        if ($response->status() == 401) {
            throw new AuthException(__('auth.token'));
        }

        return $data;
    }
}
