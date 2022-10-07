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
     * @var int $current_page
     */
    public int $current_page;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $from
     */
    public int $from;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $last_page
     */
    public int $last_page;

    /**
     * @OA\Property(ref="#/components/schemas/PaginationMetaLinks")
     *
     * @var array $links
     */
    public array $links;

    /**
     * @OA\Property(
     *     example="http://localhost:8081/api/v1/anime"
     * )
     *
     * @var string $path
     */
    public string $path;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $per_page
     */
    public int $per_page;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $to
     */
    public int $to;

    /**
     * @OA\Property(
     *     example="1"
     * )
     *
     * @var int $total
     */
    public int $total;

}
