<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Информация о выходе",
 *     type="object",
 *     title="Studio",
 * )
 */
class Studio
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
     *     example="AtelierPontdarc"
     * )
     *
     * @var string
     */
    public string $name;

}
