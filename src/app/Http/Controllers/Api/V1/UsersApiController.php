<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Repository\UserRepository;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\EditUsersRequest;
use App\Http\Requests\GetUsersListRequest;
use App\Support\Facades\Access;
use App\Support\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersApiController extends ApiController
{
    /**
     * @OA\Get  (
     *     path="/user",
     *     tags = {"Users"},
     *     summary="Отображение списка пользователей",
     *     description="Отображение списка пользователей",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Страница (по умолчанию 1). Минимум 1",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Кол-во пользователей на странице (по умолчанию 6) Минимум 1, максимум 20",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Вернет список пользователей"
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Ошибка валидации"
     *      )
     *
     * )
     */
    public function getList(GetUsersListRequest $request)
    {
        $per_page = $request->get('per_page') ? $request->get('per_page') : 6;
        $page = $request->get('page') ? $request->get('page') : 1;

        return app(UserRepository::class)->getList(['*'], true, $page, $per_page);
    }

    /**
     * @OA\Get  (
     *     path="/user/{user_id}",
     *     tags = {"Users"},
     *     summary="Вывод информации о пользователе по его id",
     *     description="Вывод информации о пользователе по его id",
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="Id пользователя",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Вернет информацию о пользователе"
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Пользователь с таким id не найден"
     *      )
     *
     * )
     */
    public function getById($user_id)
    {
        $user = app(UserRepository::class)->getUserProfile($user_id);

        if (empty($user)) {
            return $this->response->withNotFound('user');
        }

        $role = Access::getRole($user->getGroupId());

        return $this->response->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'description' => $user->description,
            'gender' => $user->gender,
            'avatar' => Image::avatar()->get($user_id),
            'group' => $role->getToArray(),
        ]);
    }

    /**
     * @OA\Post  (
     *     path="/user/{user_id}",
     *     tags = {"Users"},
     *     summary="Редактирование информации о пользователе",
     *     description="Редактирование информации о пользователе",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="Id пользователя",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Имя пользователя",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Описание пользователя (обо мне)",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         description="Пол",
     *         required=false,
     *         schema={"type": "string", "enum": {"male", "female", "other"}}
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Информация о пользователе успешно обновлена, вывод статуса и новых данных пользователя"
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Пользователь с таким id не найден"
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Ошибка валидации"
     *      )
     *
     * )
     */
    public function editProfile($user_id, EditUsersRequest $request)
    {
        if (empty($request->all())) {
            return $this->response->noChanges();
        }

        $user = app(UserRepository::class)
            ->update($user_id, $request->all(), ['name', 'description', 'gender']);

        if (! $user) {
            return $this->response->withNotFound('user');
        }

        if (! Access::checkPermission($request->user()->getGroupId(), 'users.admin.edit')) {
            return $this->response->withForbidden('Failed to save changes. You do not have permission to update the user profile.');
        }

        return $this->response->json(['status' =>'Update successfully', 'user' => $user]);
    }

    /**
     * @OA\Post  (
     *     path="/user",
     *     tags = {"Users"},
     *     summary="Редактирование профиля авторизованного полльзователя",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="Id пользователя",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Имя пользователя",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Описание пользователя (обо мне)",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         description="Пол",
     *         required=false,
     *         schema={"type": "string", "enum": {"male", "female", "other"}}
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Информация о пользователе успешно обновлена, вывод статуса и новых данных пользователя"
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Ошибка валидации"
     *      )
     *
     * )
     */
    public function editAuthProfile(EditUsersRequest $request)
    {
        $user = app(UserRepository::class)
            ->update(Auth::user()->id, $request->validationData());

        return $this->response->json(['status' =>'Update successfully', 'user' => $user]);
    }

    /**
     * @OA\Post  (
     *     path="/user/{user_id}/upload_avatar",
     *     tags = {"Users"},
     *     summary="Обновление аватара пользователя",
     *     description="Обновление аватара пользователя",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Parameter(
     *         name="avatar",
     *         in="query",
     *         description="Аватар, обязательные требования к размеру: 640x640px",
     *         required=false,
     *         @OA\Schema(
     *             type="file",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="Id пользователя",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Данный статус сигнализирует о том, что аватар пользователя был успешно загружен."
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка аутентификации."
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Ошибка валидации."
     *      )
     *
     * )
     */
    public function uploadAvatar($user_id, Request $request)
    {
        $user = app(UserRepository::class)->findById($user_id);

        if (empty($user)) {
            return $this->response->withNotFound('user');
        }

        if ($user->id !== Auth()->user()->id){
            return $this->response->withForbidden('Failed to save changes. You do not have permission to update the user avatar.');
        }

        $urls = Image::avatar()->upload($user_id, $request->file('avatar'));

        app(UserRepository::class)->updateStatusAvatar($user_id);

        return $this->response->json(['status' =>'Avatar upload successfully', 'urls' => $urls]);
    }
}
