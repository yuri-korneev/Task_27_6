<?php

namespace App\core;

interface IController{
	public function index();
}

class Controller implements IController
{

	public $model;
	public $view;
	

	public function index() {

	}

	public function __construct()
	{
		$this->view = new View();
	}

}

?>