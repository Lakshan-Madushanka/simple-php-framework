<?php

namespace Core\Types;

use Core\Exceptions\RouteExceptions\InvalidControllerException;
use Exception;
//require __DIR__ . '/../Exceptions/RouteExceptions/InvalidActionException.php';
//require __DIR__ . '/../Exceptions/RouteExceptions/InvalidControllerException.php';

class Route
{

    /**
     * @throws InvalidControllerException
     */
    public function __construct(public string $route, public ?string $controller = '', public ?string $action = '')
    {
        /*if (empty($controller)) {
            throw InvalidControllerException::make('Valid controller is required !');
        }

        if (! class_exists($controller)) {
            throw InvalidControllerException::make("Could not found valid controller [{$controller}] !");
        }

        if (empty($action)) {
            throw InvalidActionException::make(
                "Method __invoke is required if action is not defined else valid method name is required"
            );
        }

        if (! method_exists($controller, $action)) {
            throw InvalidActionException::make("Could not found valid method [{$action}]");
        }*/
    }

}