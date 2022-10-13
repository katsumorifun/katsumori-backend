<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Модель истории изменений объектов",
 *     type="object",
 *     title="HistoryChanges",
 * )
 */

class HistoryChanges
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
     *     description="старые данные",
     *      @OA\Items(
     *          type="array",
     *          @OA\Items()
     *      ),
     * )
     *
     * @var array
     */
    public array $old_data;

    /**
     * @OA\Property(
     *     description="Новые данные",
     *      @OA\Items(
     *          type="array",
     *          @OA\Items()
     *      ),
     * )
     *
     * @var array
     */
    public array $new_data;
}
