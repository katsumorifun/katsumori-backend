<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\Auth;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;
use App\Repositories\User as UserRepository;

class LoginController extends ApiController
{
    protected Auth $auth;

    public function __construct()
    {
        $this->auth = new Auth();
        parent::__construct();
    }

    /**
     * @OA\Post (
     *     path="/auth/login",
     *     tags = {"Auth"},
     *     summary="Авторизация",
     *     description="Авторизация через OAuth",
     *
     *
     *     @OA\Parameter(
     *          name = "email",
     *          in = "query",
     *          description = "Почта пользователя",
     *          required=true,
     *          @OA\Schema(
     *             type="email"
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *          name = "password",
     *          in = "query",
     *          description = "Пароль пользователя",
     *          required=true,
     *          @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Вернет refresh/access токены и данные пользователя",
     *          @OA\JsonContent(
     *              @OA\Property(ref="#/components/schemas/Tokens", property="tokens"),
     *              @OA\Property(
     *                   property="users",
     *                   type="array",
     *                   @OA\Items(ref="#/components/schemas/User")
     *              ),
     *          )
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                 property="messages",
     *                 type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="user not found",
     *                      @OA\Schema(type="string")
     *                  ),
     *              )
     *          )
     *      ),
     *
     * )
     */
    public function callback(LoginRequest $request)
    {
        $user = app(UserRepository::class)->getByEmail($request->get('email'));

        if ($user) {
            return $this->response->withNotFound('user not found');
        }

        $tokens = $this->auth->login($request->get('email'), $request->get('password'));

        return $this->response->json([
            'tokens'=> [
                'expires_in'     => $tokens->getExpiresIn(),
                'token_type'     => $tokens->getTokenType(),
                'access_token'   => $tokens->getAccessToken(),
                'refresh_token'  => $tokens->getRefreshToken(),
            ],
            'user'  => $user
        ]);
    }
}
