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
     * @var string $from
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
     * @var string $to
     */
    public string $to;
}
