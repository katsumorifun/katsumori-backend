<?php

namespace App\Models\Swagger\Aired;

/**
 * @OA\Schema(
 *     description="Информация о выходе",
 *     type="object",
 *     title="Aired",
 * )
 */
class Aired
{
    /**
     * @OA\Property(
     *     description="Дата начала показа тайтла",
     *     example="2022-07-06 12:53:13"
     * )
     *
     * @var string
     */
    public string $from;

    /**
     * @OA\Property(
     *     description="Дата выхода следующей серии",
     *     example="2022-07-06 12:53:13"
     * )
     *
     * @var string
     */
    public string $to;

    /**
     *  @OA\Property(ref="#/components/schemas/AiredProp")
     *
     * @var array
     */
    public array $prop;
}
