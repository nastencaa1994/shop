<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

require_once 'vendor/autoload.php';

require_once 'application/config/routes.php';
echo '<pre>';

//session_start();
use application\lib\Db;

$bd = new Db();

$nameTable = 'User';



$values=[
    [
        'login'=>'admin3',
        'password'=>'123',
        'name'=>'name',
        'phone'=>79991122333,
        'data_create'=>date('Y-m-d')
    ],
    [
        'login'=>'admin2',
        'password'=>'1234',
        'name'=>'name',
        'phone'=>79991122331,
        'data_create'=>date('Y-m-d')
    ],
    [
        'login'=>'admin1',
        'password'=>'1234',
        'name'=>'name',
        'phone'=>79991122331,
        'data_create'=>date('Y-m-d')
    ],
    [
        'login'=>'admin1',
        'password'=>'1234',
        'name'=>'name',
        'phone'=>79991122331,
        'data_create'=>date('Y-m-d')
    ],
    [
        'login'=>'admin6',
        'password'=>'1234',
        'name'=>'name',
        'phone'=>79991122331,
        'data_create'=>date('Y-m-d')
    ],

];

$bd->addInRowTable($nameTable,$values);











?>
