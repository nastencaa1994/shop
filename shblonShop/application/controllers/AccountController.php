<?php


namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller
{
    public function auto(){
        $this->view->render('Авторизация');
    }

    public function lk(){
        $this->view->render('Личный кабинет');
    }

    public function reg(){
        $this->view->render('Регистрация');
    }
}