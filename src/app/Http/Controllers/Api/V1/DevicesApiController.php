<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;

class DevicesApiController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');

        parent::__construct();
    }

    /**
     *
     * @OA\Post (
     *     path="/devices",
     *     tags = {"Devices"},
     *     summary="Отображение списка устройств, с которых был выполнен вход в учетную запись",
     *     description="Отображение всех устройств, с которых был выполнен вход в учетную запись",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Response(
     *          response="200",
     *          description="Cписка устройств",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device"),
     *              @OA\Items(ref="#/components/schemas/Device"),
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Ошибка аутентификации (просроченный токен, либо его отсутствие)",
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
    public function listDevices()
    {
        return Auth::user()->logins;
    }

    /**
     *
     * @OA\Post (
     *     path="/devices/current",
     *     tags = {"Devices"},
     *     summary="Отображение информаци об устройстве, с которого была произведена авторизация",
     *     description="Отображение информаци об устройстве, с которого была произведена авторизация",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Response(
     *          response="200",
     *          description="Информация об устройстве",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Ошибка аутентификации (просроченный токен, либо его отсутствие)",
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
    public function currentDevice()
    {
        return Auth::user()->currentLogin();
    }

    /**
     *
     * @OA\Post (
     *     path="/devices/logout/{id}",
     *     tags = {"Devices"},
     *     summary="Выход с устройства по id авторизации, который можно узнать в списке /devices/",
     *     description="Выход с устройства по id авторизации, который можно узнать в списке /devices/",
     *
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id логина",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
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
     *     @OA\Response(
     *          response="404",
     *          description="Ошибка аутентификации (просроченный токен, либо его отсутствие)",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthenticated",
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *          response="400",
     *          description="Id логина не найден",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="messages",
     *                  type="array",
     *                  @OA\Items(
     *                     @OA\Property(
     *                       property="error",
     *                       type="string",
     *                       example="Login id not found"
     *                     ),
     *                  )
     *              )
     *          )
     *      )
     *
     * )
     */
    public function logoutFromLoginId($login_id)
    {
        $status = Auth::user()->logout($login_id);

        if (!$status)
        {
            return $this->response->withNotFound('Login id not found');
        }

        return $this->response->json([
            'status' => 'Ok',
            'message' => 'Logged out'
        ], [], false);
    }

    /**
     *
     * @OA\Post (
     *     path="/devices/logout/all",
     *     tags = {"Devices"},
     *     summary="Выход со всех устройств",
     *     description="Выход со всех устройств",
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
     *     @OA\Response(
     *          response="404",
     *          description="Ошибка аутентификации (просроченный токен, либо его отсутствие)",
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
    public function logoutAll()
    {
        Auth::user()->logoutAll();

        return $this->response->json([
            'status' => 'Ok',
            'message' => 'Logged out'
        ], [], false);
    }
}
