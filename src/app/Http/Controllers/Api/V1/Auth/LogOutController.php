<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;

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
     *          response="404",
     *          description="Неверный пароль",
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
        if (!Auth::check())
        {
            return $this->response->unauthorized();
        }

        $token = Auth::user()->token();
        $token->revoke();

        return $this->response->json([
            'status' => 'Ok',
            'message' => 'Logged out'
        ], [], false);
    }
}
