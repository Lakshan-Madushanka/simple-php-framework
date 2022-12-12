<?php

namespace Core\Exceptions\RouteExceptions;

use Exception;

class InvalidActionException extends Exception
{
    public static function make(string $message): static
    {
        return new static(message: $message);
    }
}