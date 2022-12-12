<?php

namespace Core\Helpers;

class Str
{
    public static function StudyCase(string $text): string
    {
       return str_replace(' ', '', ucfirst(str_replace('-', ' ', $text)));
    }

    public static function camelCase(string $text): string
    {
        return lcfirst(self::StudyCase($text));
    }
}