<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     title="YukiDub API documentation",
 *     version="0.0.1",
 *     @OA\Contact(
 *         email="administrator@yukidub.fun"
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
 *     name="User"
 * )
 *
 * @OA\Tag(
 *     name="Devices"
 * )
 *
 * @OA\Server(
 *     description="v1",
 *     url="http://127.0.0.1:8081/api/v1"
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
