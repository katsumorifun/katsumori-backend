<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @internal   Just for a test
 * @deprecated Remove this class
 */
class TestController extends \Illuminate\Routing\Controller
{
    /**
     * Test queue job dispatching and processing.
     *
     * @param Dispatcher $dispatcher
     * @param CacheRepository $cache
     * @return JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function queue(Dispatcher $dispatcher, CacheRepository $cache): JsonResponse
    {
        $started_at = \microtime(true);
        $memory_bytes = \memory_get_usage();
        $random_string = Str::random();

        $dispatcher->dispatch(new \App\Jobs\TestJob($random_string));

        for ($i = 0; $i < 10 * 10; $i++) { // 10 seconds
            if ($cache->get($random_string) === true) {
                return new JsonResponse([
                    'success'      => true,
                    'duration_sec' => \microtime(true) - $started_at,
                    'memory_bytes' => \memory_get_usage() - $memory_bytes,
                ]);
            }

            \usleep(100_000);
        }

        return new JsonResponse([
            'success' => false,
            'error'   => 'job processing timeout exceeded',
        ], 500);
    }

    /**
     * Dump incoming request data.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function dump(Request $request): JsonResponse
    {
        $memory_bytes = \memory_get_usage();

        $response_data = [
            'success' => true,
            'request' => [
                'url'         => [
                    'string'   => $request->url(),
                    'full'     => $request->fullUrl(),
                    'root'     => $request->root(),
                    'path'     => $request->path(),
                    'segments' => $request->segments(),
                ],
                'method'      => $request->method(),
                'schema'      => $request->getScheme(),
                'ajax'        => $request->ajax(),
                'pjax'        => $request->pjax(),
                'prefetch'    => $request->prefetch(),
                'secure'      => $request->secure(),
                'ip'          => $request->ip(),
                'ips'         => $request->ips(),
                'user_agent'  => $request->userAgent(),
                'fingerprint' => $request->fingerprint(),
                'files'       => $request->allFiles(),
                'headers'     => $request->headers->all(),
                'content'     => $request->getContent(),
            ],
            'session' => [
                'name'         => $request->session()->getName(),
                'id'           => $request->session()->getId(),
                'previous_url' => $request->session()->previousUrl(),
                'token'        => $request->session()->token(),
            ],
        ];

        $response_data['memory_bytes'] = \memory_get_usage() - $memory_bytes;

        return new JsonResponse($response_data);
    }

    /**
     * Generates application URLs.
     *
     * @param UrlGenerator $url
     * @return  JsonResponse
     */
    public function url(UrlGenerator $url): JsonResponse
    {
        return new JsonResponse([
            'success'  => true,
            'base_url' => [
                'url_generator' => $url->to('/'),
                'facade'        => \Illuminate\Support\Facades\URL::to('/'),
                'helper'        => url('/'),
            ],
        ]);
    }

    /**
     * Test file uploading and saving using filesystem.
     *
     * @param Request    $request
     * @param Filesystem $fs
     * @return  JsonResponse
     */
    public function upload(Request $request, Filesystem $fs): JsonResponse
    {
        $started_at = \microtime(true);
        $memory_bytes = \memory_get_usage();

        $file = $request->file('data');

        if ($file instanceof UploadedFile) {
            $file->move(storage_path('app'), $file_name = Str::random(6).'_'.$file->getClientOriginalName());

            return new JsonResponse([
                'success'      => true,
                'content_size' => $fs->size($file_name),
                'duration_sec' => \microtime(true) - $started_at,
                'memory_bytes' => \memory_get_usage() - $memory_bytes,
            ]);
        }

        return new JsonResponse([
            'success' => false,
            'error'   => 'file was not submitted (use key "data" for file content)',
        ], 400);
    }
}
