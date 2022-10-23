<?php

namespace App\Contracts\Images;

use Illuminate\Http\UploadedFile;

interface ImageUpload
{
    public function save(string $disk_name, UploadedFile $image, string $name, array $sizes = ['original']): array;
}
