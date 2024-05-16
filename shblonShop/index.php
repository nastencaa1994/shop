<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);


require_once 'vendor/autoload.php';
require_once 'application/config/const.php';
require_once 'application/config/routes.php';
/**
 * require_once "application\lib\migration.php" - запускает миграцию
*/

use application\models\User;
echo '<pre>';
//$id = 1;
//$res = $user->getByIdUser($id);
//$test = $user->authorizationUser($res['login'],$res['password']);
//print_r($user);
//print_r($_COOKIE);
//if(!isset($_COOKIE['AUTHORIZATION']) && $_COOKIE['AUTHORIZATION']!=''){
//    $user = new User();
//    $userInfoDB = $user->getByIdUser($_COOKIE['AUTHORIZATION']);
//    session_start([
//        'croup-user_id' => $userInfoDB[],
//    ]);
//}

























?>
