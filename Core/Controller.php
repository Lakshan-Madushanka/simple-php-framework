<?php

namespace Core;

use Core\Exceptions\RouteExceptions\InvalidActionException;

abstract class Controller
{
    public function __construct(public array $queryParams = [])
    {
    }

    public function __call(string $name, array $arguments)
    {
        $action = $name . 'Action';


        if ( method_exists($this, $action) && ($this->before() !== false)) {

             call_user_func_array([$this, $action], $arguments);

            $this->after();

            return;
        }

        throw InvalidActionException::make("Could not found valid action [{$name}]");
    }

    public function before()
    {

    }

    public function after()
    {

    }
}