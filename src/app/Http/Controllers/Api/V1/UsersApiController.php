<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
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
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Страница (по умолчанию 1). Минимум 1",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Кол-во пользователей на странице (по умолчанию 6) Минимум 1, максимум 20",
     *         required=true,
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
}
