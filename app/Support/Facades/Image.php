<?php

namespace App\Support\Facades;

use App\Contracts\Resources\Images\Factory\ImageFactory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Contracts\Resources\Images\Image avatar()
 * @method static \App\Contracts\Resources\Images\Image poster()
 *
 * @see \Illuminate\Contracts\Auth\Access\Gate
 * @mixin ImageFactory
 */
class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ImageFactory::class;
    }
}
