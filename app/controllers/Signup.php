<?php

namespace App\controllers;
use App\core\Controller;
use App\models\Signup_model;
use App\core\View;

class Signup extends Controller{ 

    public function __construct() {
        $this->model = new Signup_model();
        $this->view = new View();
    }


    public function index() {

        $this->view->generate('signup_view.php', 'template_view.php');

        }

    public function checkSignup() {

        $data = $_POST;

        if (!empty($data)) {

            header('Content-Type: application/json');

            $errors = $this->model->validationForm($data);

            if (empty($errors)) {

                if ($this->model->signup($data)) {
                    http_response_code(201);
                    echo json_encode([
                        'success' => true
                    ]);
                    exit();
                }
        
                http_response_code(500);
                echo json_encode([
                    'success' => false
                ]);
                exit();
            }
        
            http_response_code(422);
        
            echo json_encode([
                'success' => false,
                'errors' => $errors
            ]);
        
            exit();
        }
    }
}


?>