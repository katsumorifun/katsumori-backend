<?php

namespace App\Base\Resources\Images\Factory;

use App\Base\Resources\Images\Avatar;
use App\Base\Resources\Images\Poster;
use App\Contracts\Resources\Images\Factory\ImageFactory as ImageFactoryContract;
use App\Contracts\Resources\Images\Image;
use Illuminate\Auth\AuthManager;
use Illuminate\Filesystem\FilesystemManager;

class ImageFactory implements ImageFactoryContract
{
    private AuthManager $auth;
    private FilesystemManager $filesystem_manager;

    public function __construct(AuthManager $auth, FilesystemManager $filesystem_manager)
    {
        $this->auth = $auth;
        $this->filesystem_manager = $filesystem_manager;
    }

    public function avatar(): Image
    {
        return new Avatar($this->auth, $this->filesystem_manager);
    }

    public function poster(): Image
    {
        return new Poster($this->auth, $this->filesystem_manager);
    }
}
