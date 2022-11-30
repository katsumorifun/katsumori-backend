<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class OperationError extends Exception
{
    protected string $item;

    public function __construct(string $message = "", int $code = 0, string $item = '', ?Throwable $previous = null)
    {
        $this->item = $item;
        parent::__construct($message, $code, $previous);
    }

    public function getItem()
    {
        return $this->item;
    }
}
