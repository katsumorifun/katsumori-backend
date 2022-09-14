<?php

namespace App\Services\Images\Facade;

use Illuminate\Support\Facades\Facade;

class Avatar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'avatar';
    }
}
