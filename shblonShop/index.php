<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

require_once 'vendor/autoload.php';

require_once 'application/config/routes.php';

echo '<pre>';
session_start();
print_r($_COOKIE);


use application\models\User;
$user = new User();
$id = 1;
$res = $user->getByIdUser($id);

print_r($res);






















?>
