<?php

namespace App\Services\Images;

use App\Contracts\Images\ImageUpload as AvatarsContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUpload implements AvatarsContract
{
    private array $sizes = [
        'x96' => [
            'width'  => 96,
            'height' => 150,
        ],
        'x48' => [
            'width'  => 48,
            'height' => 75,
        ],
        'preview' => [
            'width'  => 160,
            'height' => 328,
        ],
    ];

    public function save(string $disk_name, UploadedFile $image, string $name, array $sizes = []): array
    {
        $name = $name.'.'.$image->extension();

        $image = $image->storeAs('original', $name, ['disk' => $disk_name]);

        $data['original'] = '/storage/'.$disk_name.'/'.$image;

        foreach ($sizes as $size) {

            if (array_key_exists($size, $this->sizes)) {
                $data[$size] = $this->minimize($image, $disk_name, $size);
            }

        }

        return $data;
    }

    public function minimize(string $image, string $disk_name, string $size): string
    {
        $fileName = explode('/', $image);
        $fileName = end($fileName);

        $extension = explode('.', $fileName);
        $extension = end($extension);

        $path = Storage::disk($disk_name)->path($image);

        $image_minimize = Image::make($path)->resize($this->sizes[$size]['width'], $this->sizes[$size]['height'])->encode($extension);

        Storage::disk($disk_name)->put('x'.$size.'/'.$fileName, $image_minimize->__toString());

        return '/storage/'.$disk_name.'/'.$size.'/'.$fileName;
    }
}
