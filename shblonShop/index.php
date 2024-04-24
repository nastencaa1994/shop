<?php
require_once 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
use application\core\Router;

//session_start();
//
//$router = new Router;
//print_r($_REQUEST);
echo '<pre>';
//$router->run();
Router::add('/','main/index', 'MainController','index','default');
//Router::page('/about','about/index','AboutController');
Router::add('/login','account/login','Account','login','default');
//Router::add('/admin','admin/index','AdminController' , 'index');
//Router::add('/admin/news','admin/news','AdminController','index');
Router::run();
?>
