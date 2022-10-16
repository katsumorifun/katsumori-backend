<?php

namespace App\Models\Swagger\Anime;

/**
 * @OA\Schema(
 *     description="",
 *     type="object",
 *     title="AnimeItem",
 * )
 */
class AnimeItem
{
    /**
     * @OA\Property(
     *     description="Id тайтла",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *     description="Id тайтла на MyAnimeList",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $mal_id;

    /**
     * @OA\Property(ref="#/components/schemas/AnimeImages")
     *
     * @var array
     */
    public array $images;

    /**
     * @OA\approved(
     *     description="Обобрен ли тайтл модераторами",
     *     example="true"
     * )
     *
     * @var bool
     */
    public bool $approved;

    /**
     * @OA\Property(
     *     description="Название тайтла на японском",
     *     example="異世界おじさん"
     * )
     *
     * @var string
     */
    public string $title_jp;

    /**
     * @OA\Property(
     *     description="Название тайтла на английском",
     *     example="Isekai Ojisan"
     * )
     *
     * @var string
     */
    public string $title_en;

    /**
     * @OA\Property(
     *     description="Название тайтла на русском",
     *     example="Перерождение Дяди"
     * )
     *
     * @var string
     */
    public string $title_ru;

    /**
     * @OA\Property(ref="#/components/schemas/AnimeTitleSynonyms")
     *
     * @var string
     */
    public string $title_synonyms;

    /**
     * @OA\Property(
     *     example="tv"
     * )
     *
     * @var string
     */
    public string $type;

    /**
     * @OA\Property(
     *     example="manga"
     * )
     *
     * @var string
     */
    public string $source;

    /**
     * @OA\Property(
     *     example="10"
     * )
     *
     * @var int
     */
    public int $episodes;

    /**
     * @OA\Property(
     *     example="ongoing"
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * @OA\Property(
     *     example="false"
     * )
     *
     * @var bool
     */
    public bool $airing;

    /**
     * @OA\Property(ref="#/components/schemas/Aired")
     *
     * @var array
     */
    public array $aired;

    /**
     * @OA\Property(
     *     example="24 min per ep"
     * )
     *
     * @var string
     */
    public string $duration;

    /**
     * @OA\Property(
     *     example="pg-13"
     * )
     *
     * @var string
     */
    public string $age_rating;

    /**
     * @OA\Property(
     *     example="7.93"
     * )
     *
     * @var float
     */
    public float $mal_score;

    /**
     * @OA\Property()
     *
     * @var float
     */
    public float $score;

    /**
     * @OA\Property()
     *
     * @var float
     */
    public float $statistics;

    /**
     * @OA\Property(ref="#/components/schemas/Synopsis")
     *
     * @var array
     */
    public array $synopsis;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $season;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $year;

    /**
     * @OA\Property(ref="#/components/schemas/Staff")
     *
     * @var array
     */
    public array $staff;

    /**
     * @OA\Property(ref="#/components/schemas/Licensor")
     *
     * @var array
     */
    public array $licensors;

    /**
     * @OA\Property(ref="#/components/schemas/Studio")
     *
     * @var array
     */
    public array $studio;

    /**
     * @OA\Property(ref="#/components/schemas/Genre")
     *
     * @var array
     */
    public array $genres;

    /**
     * @OA\Property(ref="#/components/schemas/Theme")
     *
     * @var array
     */
    public array $theme;

}
