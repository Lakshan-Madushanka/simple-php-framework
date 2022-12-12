<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function render(string $view, array $params = []): void
    {
        extract($params, EXTR_SKIP);

        $file = __DIR__ . '/../App/Views/' . $view . '.php';

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \RuntimeException("View not found [{$view}]");
        }
    }

    public static function renderTemplate($template, array $args = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../App/Views');

        $twig = new Environment($loader);

        echo $twig->render($template, $args);


    }
}