<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Filter\FilterDTO;
use App\Contracts\History\History;
use App\Contracts\Repository\AnimeRepository;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\AnimeListRequest;
use App\Http\Requests\CreateAnimeRequest;
use App\Http\Requests\EditAnimeRequest;
use App\Http\Resources\AnimeResource;
use App\Http\Resources\HistoryResource;
use App\Services\Search\Search;
use OpenApi\Annotations as OA;

class AnimeApiController extends ApiController
{
    /**
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
        $per_page = $request->get('limit') ? $request->get('limit') : 12;
        $page = $request->get('page') ? $request->get('page') : 1;

        $data = app(AnimeRepository::class)
            ->getListAndGeneralInfoPaginate((new FilterDTO())->transform(\App\Models\Anime::class, $request), $per_page, $page);

        return AnimeResource::collection($data, function (AnimeResource $resource) {
            $resource->setProducers(true);
        });
    }

    /**
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
     * @OA\Get (
     *     path="/anime/{id}",
     *     tags = {"Anime"},
     *     summary="Получение информации о тайтле по его id",
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
     *              @OA\Items(ref="#/components/schemas/AnimeItem")
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="тайтл не найден",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  example={
     *                      "message": "Anime not found",
     *                      "errors" = {"Anime": "Anime not found"}
     *                  }
     *              )
     *          )
     *      )
     * )
     */
    public function getItem($id)
    {
        $data = app(AnimeRepository::class)->getItemWithRelations($id);

        if (empty($data)) {
            return $this->response->withNotFound('Anime');
        }

        return new AnimeResource($data);
    }

    /**
     * @OA\Post (
     *     path="/anime/{id}",
     *     tags = {"Anime"},
     *     summary="Обновление информации о тайтле",
     *     description="Для выполнения данного запроса требуется право доступа anime.update",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
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
    public function update($id, EditAnimeRequest $request)
    {
        if (empty($request->all())) {
            return $this->response->noChanges();
        }

        if ($request->user()->cannot('edit', \App\Models\Anime::class)) {
            $item = app(AnimeRepository::class)->updateWithoutSaving($id, $request->validationData());

            app(History::class)->add($item, true);

            return $this->response->moderatedStatus();
        }

        $item = app(AnimeRepository::class)->update($id, $request->validationData());

        if (! $item) {
            return $this->response->withNotFound('Anime');
        }

        return $this->response->json($item);
    }

    /**
     * @OA\Get (
     *     path="/anime/{id}/history",
     *     tags = {"Anime"},
     *     summary="Вывод истории редактирования информации о тайтле",
     *
     *     @OA\Response(
     *          response="200",
     *          description="Список изменений",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/HistoryChanges")
     *          )
     *      ),
     * )
     */
    public function getHistoryChangesList($id)
    {
        $items = app(AnimeRepository::class)->getChangesHistoryList($id);

        if (empty($items)) {
            return $this->response->withNotFound('Changes list');
        }

        return HistoryResource::collection($items);
    }

    /**
     * @OA\Get (
     *     path="/anime/{id}/moderation",
     *     tags = {"Anime"},
     *     summary="Вывод списка заявок на обновлление информации о тайтле",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Response(
     *          response="200",
     *          description="Список заявок",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/HistoryChanges")
     *          )
     *      ),
     * )
     */
    public function getModerationList($id)
    {
        if (request()->user()->cannot('moderationAnime', \App\Models\History::class)) {
            return $this->response->withError('Failed to save changes. You do not have permission to anime moderation list.');
        }

        $items = app(AnimeRepository::class)->getModerationList($id);

        if (empty($items)) {
            return $this->response->withNotFound('Moderation list');
        }

        return HistoryResource::collection($items);
    }

    /**
     * @OA\Post (
     *     path="/anime",
     *     tags = {"Anime"},
     *     summary="Добавление нового тайтла",
     *     security={
     *       {"Authorization": {}},
     *     },
     *
     *     @OA\Response(
     *          response="200",
     *          description="Успех",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/AnimeItem")
     *          )
     *      ),
     * )
     */
    public function create(CreateAnimeRequest $request)
    {
        if (request()->user()->cannot('create', \App\Models\Anime::class)) {
            return $this->response->withError('Failed to save changes. You do not have permission to create anime item.');
        }

        $item = app(AnimeRepository::class)->create($request->validationData());

        return new AnimeResource($item);
    }
}
