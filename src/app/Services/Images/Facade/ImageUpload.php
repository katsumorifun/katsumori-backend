<?php

namespace App\Services\Images\Facade;

use Illuminate\Support\Facades\Facade;

class ImageUpload extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Images\ImageUpload::class;
    }
}
