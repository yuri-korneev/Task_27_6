<?php

namespace App\data;

use RedBeanPHP\R;
use RedBeanPHP\RedException;

try{
    R::setup('sqlite:' . DATA . 'db.sqlite');
    if(!R::testConnection()) {
        throw new RedException('No connection');
    }
}

catch(RedException $e){
    exit(var_dump($e));
}

class DB {


public static function createUsers(string $username, $email, $password, $created, $role) {

        $user = R::dispense('users');
        $user->username = $username;
        $user->email = $email;
		$user->password = password_hash($password, PASSWORD_BCRYPT);
		$user->created = $created;
        $user->role = $role;
		
        return R::store($user);

}

public static function getUserByEmail(string $email) {

    if (R::count('users', 'email = ?', array($email))>0) {
        return true;
    }

    return false;

}

public static function getUserByName(string $name) {

    if (R::count('users', 'username = ?', array($name))>0) {
        return true;
    }

    return false;

}

public static function checkEmail(string $email) {

    return R::findOne('users', 'email = ?', array($email));

}

public static function checkPassword($email, $password) {

    return password_verify($password, $email->password);

}

public static function createImage(string $userID, $pathBig, $pathSmall, $created) {

    $images = R::dispense('images');
    $images->userID = $userID;
    $images->pathBig = $pathBig;
    $images->pathSmall = $pathSmall;
    $images->created = $created;
    
    return R::store($images);

}

public static function getUserID(string $email) {

    $findUser = R::findOne('users', 'email = ?', array($email));

    return $findUser['ID'];

}

public static function getUsersList(string $table) {

    return R::findAll($table);

}

public static function createComments($username, $imgLink, $comment, $created) {

    $comments = R::dispense('comments');
    $comments->username = $username;
    $comments->imgLink = $imgLink;
    $comments->comment = $comment;
    $comments->created = $created;
    
    return R::store($comments);

}

public static function checkComment($idComment, $username) {

    $findComment = R::findOne('comments', 'ID = ?', array($idComment));

    if ($findComment['username'] == $username) {
        return true;
    } else {
        return false;
    }

}

public static function checkImageName($imageName) {


    if (R::count('images', 'path_big = ?', array($imageName))>0) {

        return true;

    } else

    return false;
}

public static function checkImg($imgLink, $username) {

    $findIDUser = R::findOne('users', 'username = ?', array($username));
    $findIDImg = R::findOne('images', 'path_big = ?', array($imgLink));

    if ($findIDUser['ID'] == $findIDImg['userID']) {
        return true;
    } else {
        return false;
    }

}

public static function deleteComment($idComment) {

    $comment = R::load('comments', $idComment);
    return R::trash($comment);

}

public static function deleteImg($imgLink) {

    if(file_exists($imgLink)) {
    
        unlink($imgLink);

        $findIDImg = R::findOne('images', 'path_big = ?', array($imgLink));
        $pathSmall = $findIDImg['path_small'];

        unlink($pathSmall);

        $image = R::load('images', $findIDImg['ID']);
        R::trash($image);

        $findComments = R::find('comments', 'img_link = ?', array($imgLink));
        R::trashAll($findComments);

        return true;

    }

}

public static function getComments(string $imgLink) {

    $findComments = R::findAll('comments', 'img_link = ?', array($imgLink));

    return $findComments;

}


public static function addTokenDB($token, $email) {

    $findUser = R::findOne('users', 'email = ?', array($email));

    $findUser->token = $token;
    R::store($findUser);

    return true;


}

public static function getUserToken($token) {

    $findUser = R::findOne('users', 'token = ?', array($token));

    return $findUser['email'];

}


}

?>