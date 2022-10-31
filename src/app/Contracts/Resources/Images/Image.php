<?php

namespace App\Contracts\Resources\Images;

use Illuminate\Http\UploadedFile;
use JetBrains\PhpStorm\ArrayShape;

interface Image
{
    public function upload(int $user_id, UploadedFile $file): array;

    public function get(int $id): array;

    #[ArrayShape(['avatar_original' => 'string', 'x240' => 'string', 'x42' => 'string'])]
    public function getDefault(): array;
}
