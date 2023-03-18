<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Contracts\Repository\UserRepository;
use App\Exceptions\AuthException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateTokens;
use App\Models\User;
use App\Notifications\NotifyLogin;

class LoginController extends ApiController
{
    public function __construct()
    {
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
     *          response="404",
     *          description="Пользователь не найден",
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
     *     @OA\Response(
     *          response="400",
     *          description="Неверный пароль",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                 property="messages",
     *                 type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="wrong password",
     *                      @OA\Schema(type="string")
     *                  ),
     *              )
     *          )
     *      ),
     *
     * )
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        /**
         * @var User $user
         */
        $user = app(UserRepository::class)->getByEmail($request->get('email'));

        if (is_null($user)) {
            return $this->response->withNotFound('user');
        }

        try {

            /**
             * @var \App\Contracts\Auth\Auth $auth
             */
            $auth = app('app.auth');

            $data = $auth->attempt($request->get('email'), $request->get('password'));

            $geo_ip = geoip($request->getClientIp());

            $user->notify(new NotifyLogin(
                'site',
                '/', //На данный момент фронтенда нет, поэтому и адреса тоже нет. В будущем надо переделать
                $geo_ip->ip,
                $geo_ip->country,
                $geo_ip->city,
            ));

            return $this
                ->response
                ->json(['tokens' => $data, 'user' => $user]);

        } catch (AuthException $e) {
            return $this->response->withError($e->getMessage());
        }
    }

    /**
     * @OA\Post (
     *     path="/auth/access_token",
     *     tags = {"Auth"},
     *     summary="Обновлениме access_token через refresh_token",
     *     description="Обновлениме access_token через refresh_token",
     *
     *
     *     @OA\Parameter(
     *          name = "refresh_token",
     *          in = "query",
     *          description = "Токен обновления",
     *          required=true
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="В случае успеха будут возвращены новые access и refresh токены",
     *          @OA\JsonContent(
     *              @OA\Property(ref="#/components/schemas/Tokens", property="tokens")
     *          )
     *      ),
     *     @OA\Response(
     *          response="400",
     *          description="Ошибка получения новых токенов"
     *          )
     *      )
     *
     * )
     */
    public function updateTokens(UpdateTokens $request): \Illuminate\Http\JsonResponse
    {
        /**
         * @var \App\Contracts\Auth\Auth $auth
         */
        $auth = app('app.auth');
        try {
            $data = $auth->updateAccessToken($request->get('refresh_token'));
            return $this->response->json($data);

        } catch (AuthException $e) {
            return $this->response->withError($e->getMessage());
        }
    }
}
