<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */

use Core\Router;

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
// error_reporting(E_ALL);
// set_error_handler('Core\Error::errorHandler');
// set_exception_handler('Core\Error::exceptionHandler');

/**
 * Sessions
 */
session_start();


/**
 * Routing
 */
$router = new Router();

// Add the routes
$router->add('login', ['controller' => 'Login', 'action' => 'index']);
$router->add('login/new', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('signup', ['controller' => 'Signup', 'action' => 'index']);
$router->add('signup/create', ['controller' => 'Signup', 'action' => 'create']);
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('books', ['controller' => 'Books', 'action' => 'index']);
$router->add('books/detail/\d+', ['controller' => 'Books', 'action' => 'detail']);
$router->add('books/read/\d+', ['controller' => 'Books', 'action' => 'read']);
$router->add('cart', ['controller' => 'Cart', 'action' => 'index']);
$router->add('profile', ['controller' => 'Profile', 'action' => 'index']);
$router->add('find/\w+', ['controller' => 'FindBook', 'action' => 'index']);
//$router->add('login', ['controller' => 'Login', 'action' => 'new']);
//$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
//$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset']);
//$router->add('signup/activate/{token:[\da-f]+}', ['controller' => 'Signup', 'action' => 'activate']);
$router->add('{controller}/{action}');

$url = substr($_SERVER['REQUEST_URI'], 1);
$router->dispatch($url);
