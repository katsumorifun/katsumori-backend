<?php

namespace App\Contracts\Resources\Images\Factory;

use App\Contracts\Resources\Images\Image;

interface ImageFactory
{
    public function avatar(): Image;

    public function poster(): Image;
}
