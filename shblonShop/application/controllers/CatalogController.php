<?php


namespace application\controllers;


class CatalogController extends \application\core\Controller
{
    public function indexAction() {
//		$result = $this->model->getNews();
//		$vars = [
//			'news' => $result,
//		];
        $this->view->render('Католог', []);
    }
}