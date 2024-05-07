# shop
добавить таблицу в DB
#
use application\lib\Db;

$db = new Db();

$nameTable = 'User';

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
        'column_type' => 'BIGINT',
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


$db->addTable($nameTable, $column);

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

$db->addInRowTable($nameTable,$values);
#
Уделаение строк
#

$where=
[
    
    'login'=>'admin2',
    'name'=>'name2'
];


$db->deleteRowTable($nameTable,$where);

#
Универсальный запрос
#

$sql="SELECT * FROM User WHERE 1=1";


$res = $db->requestDB($sql);

#
Запрос строк
#

$where=
[
    'login'=>'admin2',
];

$columns=['login','password'];

//не отправлять $columns или отправлять пустой - что бы получить все столбцы

//не отправлять $where или отправлять пустой - все стороки

//$limit по умолчанию 1000

$res = $db->getRowTable($nameTable,$where,$columns,$limit);

print_r($res);

#
Удаление таблиц
#
$nameTable = "User, Catalog";

$db->dropTable($nameTable);

#
Регистрация USER
#
use application\models\User;

$user = new User();

$values=[

        'login'=>'adminTest2',
        'password'=>'123a',
        'name'=>'nameTest2',
        'phone'=>79991122444,
        'data_create'=>date('Y-m-d')
];

$res = $user->registration($values);

#
Авторизация USER
#
$user = new User();

$login='admin6';

$password='1234';

$res = $user->authorizationUser($login,$password);

#
Получить user по id
#

$user = new User();

$id = 1;

$res = $user->getByIdUser($id);

print_r($res);