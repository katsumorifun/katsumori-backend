<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Информация о выходе",
 *     type="object",
 *     title="Genre",
 * )
 */
class Genre
{
    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $mal_id;

    /**
     * @OA\Property(
     *     example="河合 滋樹"
     * )
     *
     * @var string
     */
    public string $name_jp;

    /**
     * @OA\Property(
     *     example="En"
     * )
     *
     * @var string
     */
    public string $name_en;

    /**
     * @OA\Property(
     *     example="Сигэки Кавай"
     * )
     *
     * @var string
     */
    public string $name_ru;
}
