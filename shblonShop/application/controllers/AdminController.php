<?php


namespace application\controllers;


class AdminController extends \application\core\Controller
{

    public function newsAction(){
        print_r($this->view);
        $this->view->render('Новости', []);
    }
    public function indexAction() {
        $this->view->render('Административная панель', []);
    }
}