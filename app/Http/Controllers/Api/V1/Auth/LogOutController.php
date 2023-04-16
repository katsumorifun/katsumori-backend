<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\Auth;
use App\Http\Controllers\Api\ApiController;

class LogOutController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');

        parent::__construct();
    }

    /**
     * @OA\Post (
     *     path="/auth/logout",
     *     tags = {"Auth"},
     *     summary="Отзыв токенов для выхода из учетной записи",
     *     description="Отзыв токенов для выхода из учетной записи",
     *
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Response(
     *          response="200",
     *          description="Успех",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="Ok"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Logged out"
     *              )
     *           )
     *      ),
     *
     *     @OA\Response(
     *          response="401",
     *          description="Не авторизован",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthenticated",
     *              )
     *          )
     *      )
     *
     * )
     */
    public function logOut(): \Illuminate\Http\JsonResponse
    {
        $token = \Auth::user()->token();

        /**
         * @var \App\Contracts\Auth\Auth $auth
         */
        $auth = app('app.auth');
        $auth->revokeTokens($token->id);

        return $this->response->json([
            'status' => 'Ok',
            'message' => 'Logged out',
        ]);
    }
}
