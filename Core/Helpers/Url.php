<?php

namespace Core\Helpers;

class Url
{
    public static function removeQueryString(string $url)
    {
        $pos = strpos($url, '?');

        if (! $pos) {
            return $url;
        }

        return substr_replace($url, '', $pos);
    }
}