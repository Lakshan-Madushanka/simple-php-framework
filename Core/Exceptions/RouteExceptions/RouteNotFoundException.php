<?php

namespace Core\Exceptions\RouteExceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public static function make(string $message, $code = 404): static
    {
        return new static(message: $message, code: 404);
    }
}