<?php

namespace App\Support\Facades;

use App\Contracts\Resources\Images\Factory\ImageFactory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Contracts\Resources\Images\Factory\ImageFactory avatar: Image;
 * @method static \App\Contracts\Resources\Images\Factory\ImageFactory poster: Image;
 *
 * @see \Illuminate\Contracts\Auth\Access\Gate
 */
class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ImageFactory::class;
    }
}
