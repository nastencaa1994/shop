<?php


namespace application\models;


class User extends \application\core\Model
{

    const TABLE_NAME = 'User';
    public $user;
    private $login;
    private $password;
    protected $notAddInPublicUserArr = [
        'login','password'
    ];


    protected function getUser($login, $password = '')
    {
        $where['login'] = $login;
        if(!empty($password)){
            $where['password'] =$password;
        }
        $res =   $this->db->getRowTable(self::TABLE_NAME, $where);

        if(count($res)==1){
            $this->login=$login;
            $this->password=$password;
            return $res[0];
        }else{
            return false;
        }
    }
    public function getByIdUser($id){
        $where['id_user'] = $id;
        $res = $this->db->getRowTable(self::TABLE_NAME, $where);
        if(count($res)==1){
            return $res[0];
        }else{
            return false;
        }
    }

    public function __destruct()
    {
        $this->login = '';
        $this->password = '';
        $this->user = [];
    }
}