<?php


namespace application\models;


class User extends \application\core\Model
{

    const TABLE_NAME = 'User';
    public $user;
    private $login;
    private $password;
    private $notAddInPublicUserArr = [
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

    public function authorizationUser($login,$password){
      $result = $this->getUser($login,$password);
      if($result){
          foreach ($result as $key=>$item){
              if(!in_array($key, $this->notAddInPublicUserArr))
              $this->user[$key] = $item;
          }
//          setcookie("GROUP_USER", '1', time()-3600*24);// добавить группу в таблицу
          setcookie("AUTHORIZATION", $this->user['id_user'], time()+3600*24);
          return  $this->user['id_user'];
      }else{
          return false;
      }
    }

    public function registration($data){
        $result = $this->getUser($data['login']);
        if($result){
            return 'пользоваталь с таким логином уже зарегестрирован';
        }else{
            $values[]=$data;
            $registration = $this->db->addInRowTable(self::TABLE_NAME, $values);
            if($registration == true){
                return $this->authorizationUser($data["login"],$data["password"]);
            }
        }
    }

    public function __destruct()
    {
        $this->login = '';
        $this->password = '';
        $this->user = [];
    }
}