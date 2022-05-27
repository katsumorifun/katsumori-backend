<?php

namespace App\Base\Auth;

use App\Base\Auth\Exceptions\LoginException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class Auth
{

    protected string $refresh_token = '';
    protected string $access_token = '';
    protected string $expires_in = '';
    protected string $token_type = '';

    /**
     * @throws LoginException
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
            $request = Request::create('/oauth/token', 'POST', $data);
            $data = json_decode(app()->handle($request)->getContent());
            $this->refresh_token = $data->refresh_token;
            $this->access_token = $data->access_token;
            $this->expires_in = $data->expires_in;
            $this->token_type = $data->token_type;

        } catch (\ErrorException|\Exception $ex) {
            throw new LoginException();
        }

        return $this;
    }

    public static function updateAccessToken($refreshToken)
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

        $response = Http::asForm()->post(config('app.url').'/oauth/token', $data);

        return $response->json();
    }

    /**
     * @param string $token_id
     * @return void
     */
    public static function revokeTokens(string $token_id): void
    {
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($token_id);

        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token_id);
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
}
