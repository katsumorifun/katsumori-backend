<?php

namespace App\Services\Guard;

use App\Contracts\Guard\AuthThrottle as AuthThrottleContract;
use Illuminate\Http\Request;

class AuthThrottle implements AuthThrottleContract
{
    /**
     * Настройки тротлинга.
     */
    protected array $throttle_settings;

    /**
     * Кеш.
     */
    protected \Illuminate\Contracts\Cache\Repository $cache;

    /**
     * Request.
     */
    protected \Illuminate\Http\Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->cache = app('cache.store');
        $this->throttle_settings = config('auth.throttle');
    }

    public function check(): bool
    {
        if(\App::environment() == 'testing') {
            return true;
        }

        $key = $this->getKey();

        if ($this->cache->has($key)) {

            /*
             * Количество неудачных попыток аутентификации не превышает заданное количество.
             */
            if ($this->cache->get($key) < $this->throttle_settings['attempt_count']) {
                return true;
            } else {

                /*
                 * Время блокировки подошло к концу.
                 */
                if ($this->cache->get($key.':TimeOut') + $this->throttle_settings['time_out'] < time()) {
                    return true;
                } else {
                    return false;
                }

            }

        }

        return true;
    }

    public function addFailCount()
    {
        $key = $this->getKey();

        if ($this->cache->has($key)) {

            $this->cache->increment($key);

        } else {
            $this->cache->put($key, 1, $this->throttle_settings['time_out']);
            $this->cache->put($key.':TimeOut', time(), $this->throttle_settings['time_out']);
        }
    }

    public function getTimeOut(): int
    {
        $key = $this->getKey();

        if ($this->cache->has($key)) {
            return $this->cache->get($key.':TimeOut') + $this->throttle_settings['time_out'] - time();
        } else {
            return 0;
        }

    }

    /**
     * Формирование ключа.
     */
    protected function getKey(): string
    {
        return 'AuthThrottle:'.$this->request->ip();
    }
}
