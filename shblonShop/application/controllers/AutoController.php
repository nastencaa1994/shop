<?php


namespace application\controllers;

use application\models\User;


class AutoController extends User
{
    public function authorization()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']) && isset($_POST['password'])) {
            $result = $this->getUser($_POST['login'], $_POST['password']);
            if ($result) {
                foreach ($result as $key => $item) {
                    if (!in_array($key, $this->notAddInPublicUserArr))
                        $this->user[$key] = $item;
                }
                setcookie("AUTHORIZATION", $this->user['id_user'], time() + 3600 * 24);
                header('Location: ' . '/lk');
            } else {
                return false;
            }
            print_r($_POST);
        } else {
            echo 'Неправильно переданы данный - POST(login,password)';
        }
    }

    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']) && isset($_POST['password'])) {
            $result = $this->getUser($_POST['login']);
            if ($result) {
                echo '<p>пользоваталь с таким логином уже зарегестрирован</p>';
                echo '<p><a href="/authorization">войти</a></p>';
            } else {
                $values[] = [
                    'login'=>$_POST['login'],
                    'password'=>$_POST['password'],
                    'group_user'=>3
                ];

                $registration = $this->db->addInRowTable(self::TABLE_NAME, $values);
                print_r($registration->errorInfo);
                if (!isset($registration->errorInfo)) {
                   $this->authorization();
                   echo 'регистрация';
                }else{
                    echo $registration->errorInfo[2];
                }
            }
        }
    }
}