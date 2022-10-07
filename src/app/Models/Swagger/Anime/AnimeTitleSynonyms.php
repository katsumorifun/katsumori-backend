<?php

namespace App\Models\Swagger\Anime;

/**
 * @OA\Schema(
 *     description="Альтернативные названия тайтла",
 *     type="object",
 *     title="AnimeTitleSynonyms",
 * )
 */

class AnimeTitleSynonyms
{
    /**
     * @OA\Property(
     *     description="Оригинальная версия постера",
     *     format="string",
     *     example="English"
     * )
     *
     * @var string $type
     */
    public string $type;

    /**
     * @OA\Property(
     *     description="Оригинальная версия постера",
     *     format="string",
     *     example="Ojisan in Another World"
     * )
     *
     * @var string $title
     */
    public string $title;
}
