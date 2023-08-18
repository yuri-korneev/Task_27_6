<?php

namespace App\controllers;
use App\core\Controller;
use App\models\Image_model;
use App\core\View;


class Image extends Controller{ 

    public $imgLink;

    public function __construct() {
        
        $this->model = new Image_model();
        $this->view = new View();

    }

    public function index() {

        $imgLink = $_POST['data'];

        $data = $this->model->getCommentsImg($imgLink);

        if (isset($_SESSION['logged_user'])) {

            echo $this->view->generate('image_view_auth.php', null, $data, $imgLink);

        } else {

            echo $this->view->generate('image_view.php', null, $data, $imgLink); 
        }

    }

    public function uploadComments() {

        $data = $_POST;
        $username = $_SESSION['logged_user']->username;

        if (!empty($data)) {

            $this->model->commentsDB($data, $username);

            echo $data['imgLink'];

            }

           

    }

    
    public function deleteComments() {

        $idComment = $_POST['data'];
        $username = $_SESSION['logged_user']->username;

        if (!empty($idComment)) {

            if ($this->model->deleteСommentsDB($idComment, $username)) {
            echo $idComment;

            } else {
                
                http_response_code(422);
                echo json_encode([
                    'success' => false
                ]);
                exit();
            }
           
        }
    }


    public function deleteImg() {

        $imgLink = $_POST['data'];
        $username = $_SESSION['logged_user']->username;

        if (!empty($imgLink)) {

            if ($this->model->deleteImgDB($imgLink, $username)) {

            } else {
                
                http_response_code(422);
                echo json_encode([
                    'success' => false
                ]);
                exit();
            }
           
        }
    }

}