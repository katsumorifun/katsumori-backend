<?php

namespace App\Models\Swagger\Anime;

/**
 * @OA\Schema(
 *     description="",
 *     type="object",
 *     title="AnimeImages",
 * )
 */
class AnimeImages
{
    /**
     * @OA\Property(
     *     description="Оригинальная версия постера",
     *     example="/images/anime/original/default.png"
     * )
     *
     * @var string
     */
    public string $original;

    /**
     * @OA\Property(
     *     description="Версия постера в размере 32 на 32 пикселя",
     *     example="/images/anime/x32/default.png"
     * )
     *
     * @var string
     */
    public string $x32;

    /**
     * @OA\Property(
     *     description="Версия постера в размере 64 на 64 пикселя",
     *     example="/images/anime/x64/default.png"
     * )
     *
     * @var string
     */
    public string $x64;

    /**
     * @OA\Property(
     *     description="Версия постера в размере 128 на 128 пикселей",
     *     example="/images/anime/x128/default.png"
     * )
     *
     * @var string
     */
    public string $x128;
}
