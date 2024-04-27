<?php

use application\lib\Db;

$bd = new Db();
$nameTable = 'User';

//addUser($nameTable,$bd);

addColumn($nameTable,$bd);





function addUser($nameTable,$bd){
    $column =
        [

            [
                'column_name' => 'id_user',
                'column_type' => 'VARCHAR(15)',
                'primary_key' => true,
                'auto_increment' => true,
            ],

            [
                'column_name' => 'login',
                'column_type' => 'VARCHAR(250)',
                'required' => true,
            ],

            [
                'column_name' => 'password',
                'column_type' => 'VARCHAR(20)',
                'required' => true,
            ],

            [
                'column_name' => 'name',
                'column_type' => 'VARCHAR(20)',
            ],

            [
                'column_name' => 'phone',
                'column_type' => 'INT(20)',
            ],

            [
                'column_name' => 'data_create',
                'column_type' => 'DATE',
            ],

            [
                'column_name' => 'address',
                'column_type' => 'INT(255)',
            ],

        ];
    $bd->addTable($nameTable, $column);
}
function addColumn($nameTable,$bd){
    return 'addColumn';
}







