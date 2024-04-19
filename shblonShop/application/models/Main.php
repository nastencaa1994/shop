<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public function getNews() {
		//$result = $this->db->row('SELECT title, description FROM news');
		return 'news';
	}
    public function getTableElements(){}

    public function searchTableElements(){}

    public function addTableElements(){}

    public function updateTableElements(){}

    public function deleteTableElements(){}

}