<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     title="Katsumori API documentation",
 *     version="0.0.1",
 *     @OA\Contact(
 *         email="administrator@katsumori.fun"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="Auth"
 * )
 *
 * @OA\Tag(
 *     name="Users"
 * )
 *
 * @OA\Tag(
 *     name="Devices"
 * )
 *
 * @OA\Tag(
 *     name="Anime"
 * )
 *
 * @OA\Server(
 *     description="v1",
 *     url="http://127.0.0.1:80/api/v1"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="Authorization",
 *     securityScheme="Authorization"
 * )
 */
trait Swagger
{
}
