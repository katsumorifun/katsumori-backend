<?php

namespace App\Base\Resources\Images;

use App\Contracts\Resources\Images\Image as ImageContract;

class Poster extends BaseImage implements ImageContract
{
    protected string $diskName = 'anime';
    protected string $urlsName = 'poster';

    protected array $mimeTypes = [
        'image/pjpeg',
        'image/jpeg',
        'image/x-png',
        'image/png',
    ];

    /**
     * Размеры изображений.
     *
     * @var  array<string, array<string, int>> - ['x32', 'x64', ...]
     */
    protected array $sizes = [
        'x96' => [
            'width'  => 96,
            'height' => 150,
        ],
        'x48' => [
            'width'  => 48,
            'height' => 75,
        ],
        'preview' => [
            'width'  => 160,
            'height' => 328,
        ],
    ];

    protected ?int $width = 225;
    protected ?int $height = 318;
}
