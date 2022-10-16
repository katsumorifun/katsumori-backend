<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Модаль устройства, с которого был выполнен вход",
 *     type="object",
 *     title="Synopsis",
 * )
 */
class Synopsis
{
    /**
     * @OA\Property(
     *     example="Кто же не мечтает хоть разок побывать в ином мире, наполненном магией и дивными существами?! Хотя обычный семнадцатилетний паре..."
     * )
     *
     * @var string
     */
    public string $ru;

    /**
     * @OA\Property(
     *     example="Lorem i...."
     * )
     *
     * @var string
     */
    public string $en;
}
