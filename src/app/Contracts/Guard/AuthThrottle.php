<?php

namespace App\Contracts\Guard;

interface AuthThrottle
{
    /**
     * Проверка, разрешена ли аутентификация
     */
    public function check(): bool;

    /**
     * Увеличение счетчика неудачных попыток аутентификации
     */
    public function addFailCount();

    /**
     * Получить время ожидания в секундах.
     */
    public function getTimeOut(): int;
}
