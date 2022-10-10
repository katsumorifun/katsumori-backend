<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Filter\FilterDTO;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\AnimeListRequest;
use App\Http\Resources\AnimeListResource;
use App\Repositories\Anime;
use App\Services\SearchService\Search;
use OpenApi\Annotations as OA;

class AnimeApiController extends ApiController
{
    /**
     *
     * @OA\Get (
     *     path="/anime",
     *     tags = {"Anime"},
     *     summary="Получение списка аниме тайтлов",
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Сортировка",
     *         required=false,
     *         schema={"type": "string", "enum": {"id", "episodes", "mal_id", "mal_score"}, "default": "id"}
     *     ),
     *     @OA\Parameter(
     *         name="studios",
     *         in="query",
     *         description="Фильтр по студиям (принимает в себя id студий через запятую)",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="1,2"
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="genres",
     *         in="query",
     *         description="Фильтр по жанрам (принимает в себя id жанров через запятую)",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="1,2"
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Фильтр по типу тайтла",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="tv"
     *         ),
     *     ),
     *
     *
     *     @OA\Response(
     *          response="200",
     *          description="Cписка тайтлов",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/AnimeListItem"),
     *              ),
     *              @OA\Property(
     *                  property="pagination",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PaginationMeta"),
     *              ),
     *              @OA\Property(
     *                  property="links",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PaginationLinks"),
     *              ),
     *          )
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Ошибка валидации",
     *      )
     *
     *
     * )
     */
    public function list(AnimeListRequest $request)
    {
        $per_page = $request->get('limit') ? $request->get('limit'): 12;
        $page = $request->get('page') ? $request->get('page'): 1;

        $data = app(Anime::class)
            ->getListAndGeneralInfoPaginate((new FilterDTO())->transform(\App\Models\Anime::class, $request), $per_page, $page);

        return AnimeListResource::collection($data);
    }

    /**
     *
     * @OA\Get (
     *     path="/anime/search/{value}",
     *     tags = {"Anime"},
     *     summary="Поиск тайтлов",
     *     @OA\Response(
     *          response="200",
     *          description="Cписка тайтлов",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/AnimeSearchItem"),
     *          )
     * )
     * )
     */
    public function search($value)
    {
        $data = app(Search::class)->anime($value);

        return $this->response->json($data);
    }

    /**
     *
     * @OA\Get (
     *     path="/anime/{id}",
     *     tags = {"Anime"},
     *     summary="Получение информации о тайтле",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id аниме",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Информация о тайтле",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device"),
     *              @OA\Items(ref="#/components/schemas/Device"),
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="тайтл не найден",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device"),
     *          )
     *      )
     * )
     */
    public function getItem()
    {

    }

    /**
     *
     * @OA\Post (
     *     path="/anime/{id}",
     *     tags = {"Anime"},
     *     summary="Обновление информации о тайтле",
     *     description="Для выполнения данного запроса требуется право доступа anime.update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id аниме",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Информация о тайтле",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="тайтл не найден",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      ),
     *     @OA\Response(
     *          response="403",
     *          description="недостаточно прав доступа",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Device")
     *          )
     *      )
     * )
     */
    public function update()
    {

    }
}
