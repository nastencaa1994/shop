<?php
require_once 'vendor/autoload.php';


use application\core\Router;

session_start();

$router = new Router;
$router->run();
echo '<pre>';
print_r($router);