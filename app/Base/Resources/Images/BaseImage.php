<?php

namespace App\Base\Resources\Images;

use App\Exceptions\OperationError;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

abstract class BaseImage implements \App\Contracts\Resources\Images\Image
{
    protected AuthManager $auth;
    protected Filesystem $disk;

    protected string $diskName = 'disk';

    protected string $urlsName = '_';

    /**
     * Форматы изображений.
     *
     * @var  array<string> - ['image/pjpeg', ...]
     */
    protected array $mimeTypes = [];

    /**
     * Размеры изображений.
     *
     * @var  array<string, array<string, int>> - ['x32', 'x64', ...]
     */
    protected array $sizes = [];

    protected ?int $width = null;
    protected ?int $height = null;
    protected int $maxSize = 83886080; //10 Mb

    public function __construct(AuthManager $auth, FilesystemManager $filesystem_manager)
    {
        $this->auth = $auth;
        $this->disk = $filesystem_manager->disk($this->diskName);
    }

    /**
     * Загрузка аватарки в хранилище.
     *
     * @param  int  $user_id
     * @param  UploadedFile  $file
     * @return string[]
     *
     * @throws OperationError
     */
    public function upload(int $user_id, UploadedFile $file): array
    {
        if (! in_array($file->getMimeType(), $this->mimeTypes)) {
            throw new OperationError('incorrect mime type');
        }

        if ($file->getSize() > $this->maxSize) {
            throw new OperationError('this file is large');
        }

        if (! $this->auth->guard()->check()) {
            throw new OperationError('dont have permission to access');
        }

        $img = Image::make($file->getRealPath())->encode('jpg');

        if (! is_null($this->width) && $img->getWidth() !== $this->width) {
            throw new OperationError('image width does not match the resolution');
        }

        if (! is_null($this->height) && $img->getHeight() !== $this->height) {
            throw new OperationError('image height does not match the resolution');
        }

        $name = $user_id.'.jpg';

        $this->disk->put('original/'.$name, $img->__toString());

        /** @var array $params */
        foreach ($this->sizes as $size => $params) {
            $this->disk->put($size.'/'.$name, $img->resize((int) $params['width'], (int) $params['height'])->__toString());
        }

        return $this->getUrls($user_id);
    }

    public function get(int $id): array
    {
        if ($this->checkDefault($id)) {
            return $this->getDefault();
        }

        return $this->getUrls($id);
    }

    protected function checkDefault(int $id): bool
    {
        return true;
    }

    private function getUrls(int $user_id): array
    {
        $rootUrl = $this->disk->getConfig()['url'];

        $data = [
            $this->urlsName.'_original' => $rootUrl.'/original/'.$user_id.'.jpg',
        ];

        foreach ($this->sizes as $name => $sizes) {
            $data[$name] = $rootUrl.'/'.$name.'/'.$user_id.'.jpg';
        }

        return $data;
    }

    public function getDefault(): array
    {
        $data = [
            $this->urlsName.'_original' => config('app.url').'/assets/'.$this->diskName.'/original.jpg',
        ];

        foreach ($this->sizes as $name => $sizes) {
            $data[$name] = config('app.url').'/assets/'.$this->diskName.'/'.$name.'.jpg';
        }

        return $data;
    }
}
