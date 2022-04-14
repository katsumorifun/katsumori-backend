<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\VerifyEmail;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\User;
use Illuminate\Support\Facades\Request;

class RegistrationController extends ApiController
{
    public function view(Request $request)
    {
        return view('auth/registration/registration');
    }

    /**
     * Display a listing of the resource.
     *
     * @OA\Post (
     *     path="/auth/registration",
     *     tags = {"Auth"},
     *     summary="Регистрация нового пользователя",
     *     description="После регистрации в течении 24 часов пользователь должен подтвердить свою почту (придет письмо), иначе его аккаунт будет удален",
     *
     *     @OA\Parameter(
     *          name = "name",
     *          in = "query",
     *          description = "Имя пользователя",
     *          required=true,
     *          @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *     @OA\Parameter(
     *          name = "password_confirmation",
     *          in = "query",
     *          description = "Подтверждение пароля",
     *          required=true,
     *          @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Вернет зарегистрированного пользователя",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/User")
     *          )
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Ошибки в заполнении полей",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="The email has already been taken. (and 1 more error)"
     *                 ),
     *                 @OA\Property(
     *                     property="errors",
     *                     type="array",
     *                     @OA\Items(
     *                        @OA\Property(
     *                          property="email",
     *                          type="string",
     *                          example="The email has already been taken"
     *                        ),
     *                        @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          example="The name has already been taken"
     *                        )
     *                     )
     *                 )
     *              )
     *          )
     *      ),
     *
     * )
     */
    public function callBack(RegistrationRequest $request)
    {
        //Создание нового пользователя
       $user = app(User::class)->createOrGetUser($request->get('name'), $request->get('email'), $request->get('password'));

        //Отправка сообщения с подтверждением регистрации
       app(VerifyEmail::class)->send($user->id, $user->name);
    }
}
