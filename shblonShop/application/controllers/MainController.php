<?php

namespace application\controllers;

use application\core\Controller;

/**
 * Класс для обработки главной страницы
 *
 * Class MainController
 * @package application\controllers
 */
class MainController extends Controller {

	public function index() {
//		$result = $this->model->getNews();
//		$vars = [
//			'news' => $result,
//		];
		$this->view->render('Главная страница');
	}

}