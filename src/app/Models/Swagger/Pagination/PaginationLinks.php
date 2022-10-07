<?php

namespace App\Models\Swagger\Pagination;

/**
 * @OA\Schema(
 *     description="Мета информация для пангинации",
 *     type="object",
 *     title="PaginationLinks",
 * )
 */

class PaginationLinks
{
    /**
     * @OA\Property(
     *     example="http://localhost:8081/api/v1/anime?page=1"
     * )
     *
     * @var string $first
     */
    public string $first;

    /**
     * @OA\Property(
     *     example="http://localhost:8081/api/v1/anime?page=1"
     * )
     *
     * @var string $last
     */
    public string $last;

    /**
     * @OA\Property(
     *     example="null"
     * )
     *
     * @var string $prev
     */
    public string $prev;

    /**
     * @OA\Property(
     *     example="null"
     * )
     *
     * @var string $next
     */
    public string $next;

}
