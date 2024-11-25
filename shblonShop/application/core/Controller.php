<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;

	public function __construct($route) {

	    if(isset($route['view'])){
            $this->route = $route;
            $this->view = new View($route);
            $this->model = $this->loadModel($route['controller']);
        }

	}

	public function loadModel($name) {

		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}

	}

	public function isAcl($key) {

		return in_array($this->route['action'], $this->acl[$key]);

	}

}