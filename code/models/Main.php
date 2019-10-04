<?php

namespace code\models;

use code\core\Model;

class Main extends Model {

	public function getNews() {
		$result = $this->db->row('SELECT title, description FROM news');
		return $result;
	}

}