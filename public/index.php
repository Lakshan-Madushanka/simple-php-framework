<?php


use Core\Helpers\Url;
use Core\Router;


/**
 * composer autoloader
 */

require __DIR__ . "/../vendor/autoload.php";

/**
 * Error and exception handling
 */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/*spl_autoload_register(function (string $class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $file = dirname(__DIR__) . '/' . $class . '.php';

    //echo $file;

    if (is_readable($file)) {
        require $file;
    }
});*/


/**
 * init router
 */
$router = new Router();

$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{id:\d+}/{action}', ['namespacel' => 'lakshan']);

/**
 * dispatch request url
 */
$requestUrl = $_SERVER['REQUEST_URI'];
$requestUrl = Url::removeQueryString($requestUrl);


$router->dispatch(substr_replace($requestUrl, '', 0, 1));
