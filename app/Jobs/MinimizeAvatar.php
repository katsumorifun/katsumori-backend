<?php

namespace App\Jobs;

use App\Contracts\Repository\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Image;

class MinimizeAvatar implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     *
     * Example: [32, 64, 128]
     */
    private array $sizes;
    private string $path;
    private int $user_id;
    private string $extension;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path, array $sizes, int $user_id, string $extension)
    {
        $this->path = $path;
        $this->sizes = $sizes;
        $this->user_id = $user_id;
        $this->extension = $extension;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->minimizeImage();

        app(UserRepository::class)->updateMinimizedAvatars($this->user_id, $this->extension);
    }

    protected function minimizeImage()
    {
        foreach ($this->sizes as $size) {
            $fileName = explode('/', $this->path);
            $fileName = end($fileName);

            $extension = explode('.', $fileName);
            $extension = end($extension);

            $path = Storage::disk('avatars')->path($this->path);

            $image = Image::make($path)->resize($size, $size)->encode($extension);

            Storage::disk('avatars')->put('x'.$size.'/'.$fileName, $image->__toString());
        }
    }
}
