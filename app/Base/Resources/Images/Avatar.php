<?php

namespace App\Base\Resources\Images;

use App\Contracts\Repository\UserRepository;
use App\Contracts\Resources\Images\Image;

class Avatar extends BaseImage implements Image
{
    protected string $diskName = 'avatars';
    protected string $urlsName = 'avatar';

    
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
        'x240' => [
            'width' => 240,
            'height' => 240,
        ],
        'x42' => [
            'width' => 42,
            'height' => 42,
        ],
    ];

    protected ?int $width = 640;
    protected ?int $height = 640;
    protected int $maxSize = 83886080; //10 Mb

    public function checkDefault(int $id): bool
    {
        return app(UserRepository::class)->getCustomAvatarStatus($id);
    }
}
