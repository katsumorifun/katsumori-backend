<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Информация о выходе",
 *     type="object",
 *     title="Staff",
 * )
 */

class Staff
{
    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $id
     */
    public int $id;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $mal_id
     */
    public int $mal_id;

    /**
     * @OA\Property(
     *     example="河合 滋樹"
     * )
     *
     * @var string $name_jp
     */
    public string $name_jp;

    /**
     * @OA\Property(
     *     example="En"
     * )
     *
     * @var string $name_en
     */
    public string $name_en;

    /**
     * @OA\Property(
     *     example="Сигэки Кавай"
     * )
     *
     * @var string $name_ru
     */
    public string $name_ru;

    /**
     * @OA\Property(
     *     example="/images/staff/x32/default.png"
     * )
     *
     * @var string $image_x32
     */
    public string $image_x32;

    /**
     * @OA\Property(
     *     example="/images/staff/x64/default.png"
     * )
     *
     * @var string $image_x64
     */
    public string $image_x64;

    /**
     * @OA\Property(
     *     example="/original/staff/x64/default.png"
     * )
     *
     * @var string $image_original
     */
    public string $image_original;
}
