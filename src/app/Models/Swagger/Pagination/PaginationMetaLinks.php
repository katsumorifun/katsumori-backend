<?php

namespace App\Models\Swagger\Pagination;

/**
 * @OA\Schema(
 *     description="Мета информация для пангинации",
 *     type="object",
 *     title="PaginationMetaLinks",
 * )
 */

class PaginationMetaLinks
{
    /**
     * @OA\Property(
     *     example="null"
     * )
     *
     * @var string $current_page
     */
    public string $url;

    /**
     * @OA\Property(
     *     example="&laquo; Previous"
     * )
     *
     * @var string $label
     */
    public string $label;

    /**
     * @OA\Property(
     *     example="false"
     * )
     *
     * @var bool $active
     */
    public bool $active;

}
