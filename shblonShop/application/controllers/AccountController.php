<?php

namespace application\controllers;

use application\core\Controller;

/**
 * Класс для обработки аторизации юзера
 *
 * Class AccountController
 * @package application\controllers
 */

class AccountController extends Controller {

    /**
     * Метод открывает шаблон 'Авторизация'
     */
    public function auto() {
        $this->view->render('Авторизация');
    }

    /**
     * Метод открывает шаблон 'Личный кабинет'
     */
    public function lk() {
        $this->view->render('Личный кабинет');
    }

    /**
     * Метод открывает шаблон 'Регистрация'
     */
    public function reg() {
        $this->view->render('Регистрация');
    }

}