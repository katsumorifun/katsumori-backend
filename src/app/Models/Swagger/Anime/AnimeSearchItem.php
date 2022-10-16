<?php

namespace App\Models\Swagger\Anime;

/**
 * @OA\Schema(
 *     description="",
 *     type="object",
 *     title="AnimeSearchItem",
 * )
 */
class AnimeSearchItem
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
     * @OA\Property()
     *
     * @var string
     */
    public string $image_x32;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $image_x64;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $image_x128;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $image_original;

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
     * @OA\Property()
     *
     * @var string
     */
    public string $episodes_aired;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $episodes_from;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $episodes_to;

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
     * @OA\Property()
     *
     * @var string
     */
    public string $synopsis_en;

    /**
     * @OA\Property()
     *
     * @var string
     */
    public string $synopsis_ru;

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
}
