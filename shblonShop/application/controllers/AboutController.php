<?php
namespace application\controllers;
use application\core\Controller;

class AboutController extends Controller
{
    public function indexAction() {

        $this->view->render('О нас', []);
    }
}