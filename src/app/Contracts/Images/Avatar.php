<?php

namespace App\Contracts\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface Avatar
{
    public function update(Model $user, UploadedFile $image);
}
