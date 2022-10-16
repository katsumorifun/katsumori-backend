<?php

namespace App\Models\Swagger\Auth;

/**
 * @OA\Schema(
 *     description="OAuth токены",
 *     type="object",
 *     title="Tokens",
 * )
 */
class Tokens
{
    /**
     * @OA\Property(
     *     title="expires in",
     *     description="Время жизни токена",
     *     format="string",
     *     example="14400"
     * )
     *
     * @var string
     */
    public string $expires_in;

    /**
     * @OA\Property(
     *     title="token type",
     *     description="Тип токена",
     *     format="string",
     *     example="Bearer"
     * )
     *
     * @var string
     */
    public string $token_type;

    /**
     * @OA\Property(
     *     title="access token",
     *     description="Токен доступа",
     *     format="string",
     *     example="def5020098ed1216cc97f642a468e35eb8b5a3b8a456c7663a93c6d817e4401b14493a4b078073cab8e649c9e..."
     * )
     *
     * @var string
     */
    public string $access_token;

    /**
     * @OA\Property(
     *     title="refresh token",
     *     description="Токен обновления",
     *     format="string",
     *     example="def5020098ed1216cc97f642a468e35eb8b5a3b8a456c7663a93c6d817e4401b14493a4b078073cab8e649c9e..."
     * )
     *
     * @var string
     */
    public string $refresh_token;
}
