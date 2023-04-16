<?php

namespace App\Models\Swagger\Aired;

/**
 * @OA\Schema(
 *     type="object",
 *     title="AiredProp",
 * )
 */
class AiredProp
{
    /**
     * @OA\Property(
     * )
     *
     * @var string
     */
    public string $from;

    /**
     * @OA\Property(
     *     property="to",
     *     type="array",
     *     @OA\Items(
     *         type="array",
     *         @OA\Items()
     *     ),
     * )
     *
     * @var string
     */
    public string $to;
}
