<?php

namespace App;

require_once 'core/config.php';

require_once 'core/model.php'; 
require_once 'core/view.php'; 
require_once 'core/controller.php'; 

require_once 'core/route.php'; 

require_once './vendor/autoload.php'; 

require_once 'data/DB.php';

session_start();


if (isset( $_COOKIE['username']) || isset($_COOKIE['token']) ) {
 
    $email = data\DB::getUserToken($_COOKIE['token']);
    $user = data\DB::checkEmail($email);
    $_SESSION["logged_user"] = $user;

} 


core\Route::start(); // запускаем 


?>