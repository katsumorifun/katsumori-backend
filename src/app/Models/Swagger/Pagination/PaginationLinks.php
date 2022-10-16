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
     * @var string
     */
    public string $first;

    /**
     * @OA\Property(
     *     example="http://localhost:8081/api/v1/anime?page=1"
     * )
     *
     * @var string
     */
    public string $last;

    /**
     * @OA\Property(
     *     example="null"
     * )
     *
     * @var string
     */
    public string $prev;

    /**
     * @OA\Property(
     *     example="null"
     * )
     *
     * @var string
     */
    public string $next;

}
