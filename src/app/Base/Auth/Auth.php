<?php

namespace App\Base\Auth;

class Auth
{

    protected string $refreshToken = '';
    protected string $accessToken = '';


    /**
     * @throws AuthException
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
            $this->accessToken = $data->access_token;
            $this->refreshToken = $data->refresh_token;

        } catch (\ErrorException $ex) {

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
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
