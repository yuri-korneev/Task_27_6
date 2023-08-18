<?php

namespace App\controllers;
use App\core\Controller;
use App\models\Login_model;
use App\core\View;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Login extends Controller{ 

    public function __construct() {
        $this->model = new Login_model();
        $this->view = new View();
    }


    public function index() {

        $csrf = hash('gost-crypto', random_int(0,999999));
        $_SESSION["CSRF"] = $csrf;

        $this->view->generate('login_view.php', 'template_view.php', $csrf);

        }

    public function checkLogin() {

        $data = $_POST;

        if (!empty($data)) {

            header('Content-Type: application/json');

            $errors = $this->model->validationLoginForm($data);

            if (empty($errors)) {

                if ($this->model->login($data['email'])) {

                    unset($_COOKIE['token']);
                    unset($_COOKIE['username']);
                    setcookie('token', null, -1, '/');
                    setcookie('username', null, -1, '/');

                   if (!empty($data['remember'])) {

                    if ($this->model->setToken($data['email'])) {

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

            $log = new Logger('login_log');
            $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/login.log', Logger::INFO));
            $log->info('login errors:', array('datetime' => date('Y-m-d H:i:s'), 'email' => $data['email'], 'password' => $data['password'], 'errors' => $errors));
        
            http_response_code(422);
        
            echo json_encode([
                'success' => false,
                'errors' => $errors
            ]);
        
            exit();
        }
    }

    public function checkLoginVK() {

        if (!empty($_GET['code'])) {
            $params = array(
                'client_id'     => '51730988',
                'client_secret' => '3tqUz8HMVALTdHqXYzst3tqUz8HMVALTdHqXYzst',
                'redirect_uri'  => 'http://localhost:8000/login/checkLoginVK',
                'code'          => $_GET['code']
            );


        $data = @file_get_contents('https://oauth.vk.com/access_token?' . urldecode(http_build_query($params)));
        $data = json_decode($data, true);

        if (!empty($data['access_token'])) {
           
            $_SESSION["logged_user"] = $data;
            $_SESSION["username"] = $data['first_name'];
            $_SESSION["role"] = 'VK';

            }

            exit("Что-то с токином");

        }

        exit("Что-то пошло не так");

    }

    public function loginVK() {
  
            unset($_SESSION["logged_user"]);

            $_SESSION["username"] = 'user VK';
            $_SESSION["role"] = 'VK';
     
    }



    public function logout() {

        unset($_SESSION["logged_user"]);
        unset($_SESSION["username"]);
        unset($_SESSION["role"]);

        unset($_COOKIE['token']);
        unset($_COOKIE['username']);
        setcookie('token', null, -1, '/');
        setcookie('username', null, -1, '/');
        
        header('Location: /');

        }

}


?>