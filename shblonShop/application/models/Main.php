<?php

namespace application\models;

use application\core\Model;

/**
 * Класс для обработки общих запросов для всех страниц
 *
 * Class Main
 * @package application\models
 */
class Main extends Model {

    /**
     * TODO - создать отдельный контроллер и модель для работы с новостями
     * @return string
     */
	public function getNews() {
		//$result = $this->db->row('SELECT title, description FROM news');
		return 'news';
	}

}