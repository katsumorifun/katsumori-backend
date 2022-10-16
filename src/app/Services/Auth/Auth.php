<?php

namespace App\Services\Auth;

use App\Contracts\Auth\Auth as AuthContract;
use App\Contracts\Guard\AuthThrottle;
use App\Exceptions\OperationError;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class Auth implements AuthContract
{
    protected TokenRepository $token_repository;
    protected RefreshTokenRepository $refresh_token_repository;
    protected string $refresh_token;
    protected string $access_token;
    protected string $expires_in;
    protected string $token_type;
    protected AuthThrottle $auth_throttle;

    public function __construct(Application $app)
    {
        $this->auth_throttle = $app->make(AuthThrottle::class);
        $this->token_repository = $app->make(TokenRepository::class);
        $this->refresh_token_repository = $app->make(RefreshTokenRepository::class);
    }

    /**
     * @throws OperationError
     */
    public function attempt(string $email, string $password)
    {
        if(! $this->auth_throttle->check()) {
            throw new OperationError(__('auth.throttle', ['seconds' => $this->getThrottleTimeOut()]));
        }

        $this->login($email, $password);
    }

    /**
     * @throws OperationError
     */
    public function login(string $email, string $password)
    {
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        $data = [
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $email,
            'password'      => $password,
            'scope'         => '*',
        ];

        try {
            $data = $this->oauthToken($data);

            $this->refresh_token = $data->refresh_token;
            $this->access_token = $data->access_token;
            $this->expires_in = $data->expires_in;
            $this->token_type = $data->token_type;

        } catch (\ErrorException|\Exception $ex) {
            $this->auth_throttle->addFailCount();
            throw new OperationError(__('auth.password'));
        }
    }

    public function updateAccessToken(string $refreshToken)
    {
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        $data = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'scope'         => '',
        ];

        return $this->oauthToken($data);
    }

    public function revokeTokens(string $token_id)
    {
        $this->token_repository->revokeAccessToken($token_id);
        $this->refresh_token_repository->revokeRefreshTokensByAccessTokenId($token_id);
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getExpiresIn(): string
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    private function getThrottleTimeOut(): int
    {
        return $this->auth_throttle->getTimeOut();
    }

    public function getData(): array
    {
        return [
            'expires_in'  => $this->expires_in,
            'token_type'  => $this->token_type,
            'access_token'  => $this->access_token,
            'refresh_token' => $this->refresh_token,
        ];
    }

    protected function oauthToken(array $data)
    {
        $request = Request::create(
            '/oauth/token',
            'POST',
            $data,
            [],
            [],
            ['HTTP_USER_AGENT' => config('app.name')],
        );

        return json_decode(app()->handle($request)->getContent());
    }
}
