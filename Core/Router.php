<?php


namespace Core;


use BadMethodCallException;
use Core\Exceptions\RouteExceptions\InvalidActionException;
use Core\Exceptions\RouteExceptions\InvalidControllerException;
use Core\Exceptions\RouteExceptions\RouteNotFoundException;
use Core\Helpers\Str;


class Router
{
    /**
     * Route Table
     *
     * @var array
     * [route => new Route]
     */
    protected array $routes = [];

    protected array $currentRouteParams = [];

    /**
     * Add route to route table
     *
     * @param  string  $route
     * @param  array  $params
     *
     * @return void
     */
    public function addRoute(string $route, array $params = []): void
    {
        /*
         * we need to convert route to regular expression so that
         * we can match request url
         */
        $route = $this->convertRouteToRegularExpression($route);

        $this->routes[$route] = $params;
    }

    public function match(string $currentRoute): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $currentRoute, $matches)) {

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                $this->currentRouteParams = $params;

                return true;
            }
        }

        return false;
    }

    public function convertRouteToRegularExpression(string $route): string
    {
        // convert / to \/
        $route = preg_replace('/\//', '\\/', $route);

        // convert {controller} to ?P<controller>[a-z]+
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z]+)', $route);

        // convert {id:\d+} to ?P<id>\d+
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = "/^{$route}$/i";

        return $route;
    }

    /**
     * @param  string  $url
     *
     * @return mixed
     * @throws InvalidActionException
     * @throws InvalidControllerException
     */
    public function dispatch(string $url): void
    {

        // new Posts()
        if ($this->match($url)) {

            $controller = Str::StudyCase($this->currentRouteParams['controller']);

            $controller = $this->getCurrentRouterNamespace().$controller;

            echo 'namespace  '.$controller;

            $action = Str::camelCase($this->currentRouteParams['action']);

            if (class_exists($controller)) {
                $controllerObj = new $controller(queryParams: $this->currentRouteParams);

                if (preg_match('/action$/i', $action) === 0) {
                    $controllerObj->$action();
                } else {
                    throw new BadMethodCallException(
                        'Actions cannot be called directly make sure remove the action suffix'
                    );
                }
            } else {
                throw InvalidControllerException::make("Could not found valid controller [{$controller}] !");
            }

        } else {
            throw RouteNotFoundException::make("Route [{$url}] not found");
        }
    }


    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getCurrentRouteParams(): array
    {
        return $this->currentRouteParams;
    }

    public function getCurrentRouterNamespace()
    {
        $namespace = $this->currentRouteParams['namespace'] ?? 'App\\Controller\\';

        if (!preg_match('/\\\\$/', $namespace)) {
            echo 'am i here';
            $namespace .= '\\';
        }

        return $namespace;
    }
}