<?php

require_once 'application/lib/Dev.php';
echo '<pre>';
use application\core\Router;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router;

//$router->add('catalog', ['catalog' => [
//    'controller' => 'catalog',
//    'action' => 'index']]);
$router->run();
print_r($router);