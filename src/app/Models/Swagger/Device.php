<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     description="Модаль устройства, с которого был выполнен вход",
 *     type="object",
 *     title="Device",
 * )
 */

class Device
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Id авторизации",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var string
     */
    public string $id;

    /**
     * @OA\Property(
     *     title="created_at",
     *     description="Дата входа",
     *     format="string",
     *     example="2022-05-28T17:07:59.000000Z"
     * )
     *
     * @var string
     */
    public string $created_at;

    /**
     * @OA\Property(
     *     title="updated_at",
     *     description="Дата обновления входа",
     *     format="string",
     *     example="2022-05-28T17:07:59.000000Z"
     * )
     *
     * @var string
     */
    public string $updated_at;

    /**
     * @OA\Property(
     *     title="user_agent",
     *     description="User agent",
     *     format="string",
     *     example="YukiDubFunWeb"
     * )
     *
     * @var string
     */
    public string $user_agent;

    /**
     * @OA\Property(
     *     title="ip",
     *     description="Ip пользователя",
     *     format="string",
     *     example="127.0.0.1"
     * )
     *
     * @var string
     */
    public string $ip;

    /**
     * @OA\Property(
     *     title="ip_data",
     *     description="Допллнительная информация (на данный момент всегда пустая)",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $ip_data;

    /**
     * @OA\Property(
     *     title="device_type",
     *     description="Тип устройства",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $device_type;

    /**
     * @OA\Property(
     *     title="device",
     *     description="Устройство",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $device;

    /**
     * @OA\Property(
     *     title="platform",
     *     description="Платформа",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $platform;

    /**
     * @OA\Property(
     *     title="browser",
     *     description="Браузер (если вход был произведен через него)",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $browser;

    /**
     * @OA\Property(
     *     title="city",
     *     description="Город",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $city;

    /**
     * @OA\Property(
     *     title="region",
     *     description="Регион",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $region;

    /**
     * @OA\Property(
     *     title="country",
     *     description="Страна",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $country;

    /**
     * @OA\Property(
     *     title="is_current",
     *     description="Это устройство",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $is_current;
}
