<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Image;

class MinimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     *
     * Example: [32, 64, 128]
     */
    private array $sizes;

    private string $path;

    private string $storage_disk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path, array $sizes, string $storage_disk)
    {
        $this->path = $path;
        $this->sizes = $sizes;
        $this->storage_disk = $storage_disk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->sizes as $size) {
            $fileName = explode('/', $this->path);
            $fileName = end($fileName);

            $extension = explode('.', $fileName);
            $extension = end($extension);

            $path = Storage::disk($this->storage_disk)->path($this->path);

            $image = Image::make($path)->resize($size, $size)->encode($extension);

            Storage::disk('avatars')->put('x' . $size . '/' . $fileName, $image->__toString());
        }
    }
}
