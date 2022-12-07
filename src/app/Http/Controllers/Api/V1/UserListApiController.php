<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Filter\AnimeFilterDTO;
use App\Contracts\Repository\AnimeRepository;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\AnimeResource;
use Illuminate\Http\Request;

class UserListApiController extends ApiController
{
    /**
     * @OA\Get  (
     *     path="/user/{user_id}/list/anime",
     *     tags = {"Users", "Anime"},
     *     summary="Отображение тайтлов из библиотеки пользователя",
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
     *         name="status",
     *         in="query",
     *         description="Статус (по умолчанию будут выведены тайты со всеми статусами)",
     *         required=false,
     *         schema={"type": "string", "enum": {"watching", "completed", "hold", "dropped", "planned"}}
     *     ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="Выведет список со всеми тайтлами поьзователя"
     *      ),
     * )
     */
    public function getAnime($user_id, Request $request)
    {
        $list = app(AnimeRepository::class)
            ->getUserList(
                $user_id,
                (new AnimeFilterDTO())->transform(\App\Models\Anime::class, $request),
                $request->get('list_status')
            );

        return AnimeResource::collection($list, function (AnimeResource $resource) {
            $resource->setProducers(false);
            $resource->isListStatus(true);
            $resource->isStaff(false);
            $resource->isCharacters(false);
        });
    }
}
