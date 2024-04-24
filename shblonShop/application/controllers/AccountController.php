<?php


namespace application\controllers;


class AccountController extends \application\core\Controller
{
    public function loginAction(){
        echo 'loginAction lf l f';
        $this->view->render('Новости', []);
    }
}