<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Модель пользователя",
 *     type="object",
 *     title="User",
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="name",
     *     description="Имя пользователя",
     *     format="string",
     *     example="Admin"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="email",
     *     description="Email пользователя",
     *     format="string",
     *     example="admin@google.com"
     * )
     *
     * @var string
     */
    public string $email;
}
