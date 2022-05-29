<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\EditUsersRequest;
use App\Http\Requests\GetUsersListRequest;
use App\Repositories\User;

class UsersApiController extends ApiController
{
    /**
     *
     * @OA\Get  (
     *     path="/users",
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
        $per_page = $request->get('per_page') ? $request->get('per_page'): 6;
        $page = $request->get('page') ? $request->get('page'): 1;

        return app(User::class)->getList(['*'], true, $page, $per_page);
    }


    /**
     *
     * @OA\Get  (
     *     path="/users/{user_id}",
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
        $user = app(User::class)->findById($user_id);

        if (empty($user)) {
            return $this->response->withNotFound('User not found');
        }

        return $user;
    }

    /**
     *
     * @OA\Post  (
     *     path="/users/{user_id}/edit",
     *     tags = {"Users"},
     *     summary="Редактирование информации о пользователе",
     *     description="Редактирование информации о пользователе",
     *
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
     *
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Имя пользователя",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Оаписание пользователя (обо мне)",
     *         required=false,
     *         @OA\Schema(
     *             type="String",
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Информация о пользователе успешно обновлена, вывод статуса и новых данных пользователя"
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Пользователь с таким id не найден"
     *      )
     *
     * )
     */
    public function editProfile($user_id, EditUsersRequest $request)
    {
        $user = app(User::class)->findById($user_id);

        if (empty($user)) {
            return $this->response->withNotFound('User not found');
        }

        if ($user->id !== Auth()->user()->id){
            return $this->response->withForbidden("Failed to save changes. You don't have enough rights");
        }

        if($request->get('name')) {
            $user->name = $request->get('name');
        }

        if ($request->get('description')) {
            $user->description = $request->get('description');
        }

        $user->save();

        return $this->response->json(['status' =>'Update successfully', 'user' => $user], [], false);
    }
}
