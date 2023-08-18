<?php

namespace App\models;
use App\core\Model;
use App\data\DB;

class Signup_model extends Model
{
    public function __construct() {
        $this->connectDB = new DB();
    }
    
	public function validationForm(array $request) {

        $errors = array();

    if (!isset($request['email']) || strlen($request['email']) == 0) {
        $errors[]['email'] = 'Email не указан';
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[]['email'] = 'Неправильный формат email';
    } elseif (strlen($request['email']) < 4) {
        $errors[]['email'] = 'Email должен быть больше 4х символов';
    } 

    elseif ($this->isLoginExists($request['name'])) {
        $errors[]['email'] = 'Логин уже используется';
    }

    elseif ($this->isEmailExists($request['email'])) {
        $errors[]['email'] = 'Email уже используется';
    }

    if (!isset($request['name']) || empty(trim(($request['name'])))) {
        $errors[]['name'] = 'Имя не указано';    }
    if (!isset($request['password']) || empty($request['password'])) {
        $errors[]['password'] = 'Пароль не указан';
    }

    if (!isset($request['repeat-password']) || empty(trim(($request['repeat-password'])))) {
        $errors[]['repeat-password'] = 'Нужно повторить пароль';
    } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {
        $errors[]['repeat-password'] = 'Пароли не совпадают';
    }

        return $errors;
    
    }
    
    public function isEmailExists(string $email) {

    if ($this->connectDB->getUserByEmail($email)) {
        return true;
    }
        return false;
    }


    public function isLoginExists(string $name) {

        if ($this->connectDB->getUserByName($name)) {
            return true;
        }
            return false;
        }

	public function signup(array $entity) {

        $username = $entity['name'];
        $email = $entity['email'];
        $password = $entity['password'];
		$created = date('Y-m-d H:i:s');

        if (!empty($data['remember'])) {
            $role = 'user';
        } else {
            $role = 'admin';
        }

        return $this->connectDB->createUsers($username, $email, $password, $created, $role);

	}

	}

?>