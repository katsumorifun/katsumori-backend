<?php

namespace App\Contracts\Resources\Images;

use Illuminate\Http\UploadedFile;
use JetBrains\PhpStorm\ArrayShape;

interface Image
{
    public function upload(int $user_id, UploadedFile $file): array;

    public function get(int $id): array;

    public function getDefault(): array;
}
