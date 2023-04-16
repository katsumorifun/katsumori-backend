<?php

namespace App\Services\Guard;

use App\Contracts\Guard\AuthThrottle as AuthThrottleContract;
use Illuminate\Http\Request;

class AuthThrottle implements AuthThrottleContract
{
    /**
     * Кеш.
     */
    protected \Illuminate\Contracts\Cache\Repository $cache;

    /**
     * Время тротлинга.
     */
    protected int $timeOut = 60 * 25;

    /**
     * Кол-во попыток.
     */
    protected int $attempt_count = 10;

    /**
     * Request.
     */
    protected \Illuminate\Http\Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->cache = app('cache.store');
    }

    /**
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function check(): bool
    {
        $key = $this->getKey();

        if ($this->cache->has($key)) {

            /*
             * Количество неудачных попыток аутентификации не превышает заданное количество.
             */
            if ($this->cache->get($key) < $this->attempt_count) {
                return true;
            } else {

                /*
                 * Время блокировки подошло к концу.
                 */
                if ($this->cache->get($key.':TimeOut') + (int) $this->timeOut < time()) {
                    return true;
                } else {
                    return false;
                }

            }

        }

        return true;
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function addFailCount()
    {
        $key = $this->getKey();

        if ($this->cache->has($key)) {

            $this->cache->increment($key);

        } else {
            $this->cache->put($key, 1, $this->timeOut);
            $this->cache->put($key.':TimeOut', time(), $this->timeOut);
        }
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getTimeOut(): int
    {
        $key = $this->getKey();

        if ($this->cache->has($key)) {
            return $this->cache->get($key.':TimeOut') + $this->timeOut - time();
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

    /**
     * @param int $timeOut
     */
    public function setTimeOut(int $timeOut)
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @param int $attempt_count
     */
    public function setAttemptCount(int $attempt_count)
    {
        $this->attempt_count = $attempt_count;
    }
}
