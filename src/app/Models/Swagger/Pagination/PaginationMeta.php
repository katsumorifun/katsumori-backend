<?php

namespace App\Models\Swagger\Pagination;

/**
 * @OA\Schema(
 *     description="Мета информация для пангинации",
 *     type="object",
 *     title="PaginationMeta",
 * )
 */
class PaginationMeta
{
    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $current_page;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $from;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $last_page;

    /**
     * @OA\Property(ref="#/components/schemas/PaginationMetaLinks")
     *
     * @var array
     */
    public array $links;

    /**
     * @OA\Property(
     *     example="http://localhost:8081/api/v1/anime"
     * )
     *
     * @var string
     */
    public string $path;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $per_page;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $to;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int
     */
    public int $total;

}
