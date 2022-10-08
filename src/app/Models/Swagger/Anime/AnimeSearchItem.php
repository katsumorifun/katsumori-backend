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
     * @var integer
     */
    public int $id;

    /**
     * @OA\Property(
     *     description="Id тайтла на MyAnimeList",
     *     example="1"
     * )
     *
     * @var integer
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
     * @var boolean $approved
     */
    public bool $approved;

    /**
     * @OA\Property(
     *     description="Название тайтла на японском",
     *     example="異世界おじさん"
     * )
     *
     * @var string $title_jp
     */
    public string $title_jp;

    /**
     * @OA\Property(
     *     description="Название тайтла на английском",
     *     example="Isekai Ojisan"
     * )
     *
     * @var string $title_en
     */
    public string $title_en;

    /**
     * @OA\Property(
     *     description="Название тайтла на русском",
     *     example="Перерождение Дяди"
     * )
     *
     * @var string $title_ru
     */
    public string $title_ru;

    /**
     * @OA\Property(ref="#/components/schemas/AnimeTitleSynonyms")
     *
     * @var string $title_synonyms
     */
    public string $title_synonyms;

    /**
     * @OA\Property(
     *     example="tv"
     * )
     *
     * @var string $type
     */
    public string $type;

    /**
     * @OA\Property(
     *     example="manga"
     * )
     *
     * @var string $source
     */
    public string $source;

    /**
     * @OA\Property(
     *     example="10"
     * )
     *
     * @var int $episodes
     */
    public int $episodes;

    /**
     * @OA\Property(
     *     example="ongoing"
     * )
     *
     * @var string $status
     */
    public string $status;

    /**
     * @OA\Property(
     *     example="false"
     * )
     *
     * @var bool $airing
     */
    public bool $airing;

    /**
     * @OA\Property(ref="#/components/schemas/Aired")
     *
     * @var array $aired
     */
    public array $aired;

    /**
     * @OA\Property(
     *     example="24 min per ep"
     * )
     *
     * @var string $duration
     */
    public string $duration;

    /**
     * @OA\Property(
     *     example="pg-13"
     * )
     *
     * @var string $age_rating
     */
    public string $age_rating;

    /**
     * @OA\Property(
     *     example="7.93"
     * )
     *
     * @var float $mal_score
     */
    public float $mal_score;

    /**
     * @OA\Property()
     *
     * @var float $score
     */
    public float $score;

    /**
     * @OA\Property()
     *
     * @var float $statistics
     */
    public float $statistics;

    /**
     * @OA\Property(ref="#/components/schemas/Synopsis")
     *
     * @var array $synopsis
     */
    public array $synopsis;

    /**
     * @OA\Property()
     *
     * @var string $season
     */
    public string $season;

    /**
     * @OA\Property()
     *
     * @var string $year
     */
    public string $year;

    /**
     * @OA\Property(ref="#/components/schemas/Staff", property="producers")
     *
     * @var array $producers
     */
    public array $producers;

    /**
     * @OA\Property(ref="#/components/schemas/Studio")
     *
     * @var array $studio
     */
    public array $studio;

    /**
     * @OA\Property(ref="#/components/schemas/Genre")
     *
     * @var array $genres
     */
    public array $genres;


}
