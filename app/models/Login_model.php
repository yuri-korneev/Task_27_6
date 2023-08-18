<?php

namespace App\models;
use App\core\Model;
use App\data\DB;



class Login_model extends Model
{
    public function __construct() {
        $this->connectDB = new DB();
    }
    
	public function validationLoginForm(array $request) {

        $errors = array();

        if ($_POST["token"] !== $_SESSION["CSRF"]) {
            $errors[]['email'] = 'Доступ запрещен';
        }

        if (!isset($request['email']) || strlen($request['email']) == 0) {
            $errors[]['email'] = 'Email не указан';
        }
        if (!isset($request['password']) || empty($request['password'])) {
            $errors[]['password'] = 'Пароль не указан';
        }
    
        $user = $this->connectDB->checkEmail($request['email']);

        if ($user === null) {
            $errors[]['email'] = 'Пользователя с таким Email не зарегистрировано';
        } else {
            if (!$this->connectDB->checkPassword($user, $request['password'])) {
                $errors[]['password'] = "Неверно введен пароль";
            }
        }

        return $errors;
    
    }

    public function login(string $email)
    {

    $user = $this->connectDB->checkEmail($email);
    $_SESSION["logged_user"] = $user;

    return true;

    }


    public function setToken($email)
    {
        $token = hash('gost-crypto', random_int(0,999999));

        setcookie('token', $token, time() + 3600 * 24 * 3, '/');
        setcookie('username', $_SESSION['logged_user']->username, time() + 3600 * 24 * 3, '/');

        if($this->connectDB->addTokenDB($token, $email)) {

            return true;

        }


    }

	}

?>