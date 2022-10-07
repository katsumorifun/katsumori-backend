<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Информация о выходе",
 *     type="object",
 *     title="Licensor",
 * )
 */

class Licensor
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
     *     example="name"
     * )
     *
     * @var string $name
     */
    public string $name;

}
