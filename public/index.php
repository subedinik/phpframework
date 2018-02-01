<?php
/*
Front Controller
*/
/*
 Routing*/
// require '../App/Controllers/Posts.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';
// Twig_Autoloader::register();
// require '../Core/Router.php';
/* Auto Loader */
spl_autoload_register(function ($class)
{
    $root = dirname(__DIR__); //get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';

    if (is_readable($file))
    {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

// Error and exception handling
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

// Routing
/**
Create object of router class
*/
$router = new Core\Router();
//Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

//Display the routing table
// echo '<pre>';
// var_dump($router->getRoutes());
// echo '</pre>';
// //match the requested route
// $url = $_SERVER['QUERY_STRING'];
// if($router->match($url))
// {
// 	echo '<pre>';
// 	var_dump($router->getParams());
// 	echo '<pre>';
// }
// else
// {
// 	echo "No route found for URL '$url'";
// }
$router->dispatch($_SERVER['QUERY_STRING']);
