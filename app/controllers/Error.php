<?php

namespace App\controllers;
use App\core\Controller;

class Error extends Controller{ 

public function index() {

$this->view->generate('error_view.php', 'template_view.php'); 

}

}

?>