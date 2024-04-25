# shop
добавить таблицу в DB
#
use application\lib\Db;

$bd = new Db();

$nameTable = 'User';

$column = 
[
    
    [
        'column_name' => 'id_user',
        'column_type' => 'VARCHAR(15)',
        'primary_key' => true,
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

#
Добавление строк в DB
#

$nameTable = 'User';

$values=[

    [
        'login'=>'admin',
        'password'=>'123',
        'name'=>'name',
        'phone'=>79991122333,
        'data_create'=>date('Y-m-d')
    ],
    [
        'login'=>'admin2',
        'password'=>'1234',
        'name'=>'name2',
        'phone'=>79991122331,
        'data_create'=>date('Y-m-d')
    ],
    
];

$bd->addInRowTable($nameTable,$values);


