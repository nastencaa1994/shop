<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

require_once 'vendor/autoload.php';
require_once 'application/config/const.php';
require_once 'application/config/routes.php';


echo '<pre>';

$db = new \application\lib\Db();



//session_start();
//print_r($_COOKIE);

require_once "application\lib\migration.php"

//use application\models\User;
//$user = new User();
//print_r($user);
//$id = 1;
//$res = $user->getByIdUser($id);
//
//print_r($res);






















?>
