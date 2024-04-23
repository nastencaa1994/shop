<?php
require_once 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
use application\core\Router;

session_start();

$router = new Router;
$router->run();
//echo '<pre>';
//print_r($router);
?>
