<?php


namespace application\controllers;


class AccountController extends \application\core\Controller
{
    public function loginAction(){
        $this->view->render('Авторизация');
    }
}