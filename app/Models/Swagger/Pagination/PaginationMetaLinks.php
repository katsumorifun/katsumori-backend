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
     * @var string
     */
    public string $url;

    /**
     * @OA\Property(
     *     example="&laquo; Previous"
     * )
     *
     * @var string
     */
    public string $label;

    /**
     * @OA\Property(
     *     example="false"
     * )
     *
     * @var bool
     */
    public bool $active;

}
