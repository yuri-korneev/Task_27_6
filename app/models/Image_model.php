<?php

namespace App\models;
use App\core\Model;
use App\data\DB;

class Image_model extends Model
{
    public function __construct() {        
        $this->connectDB = new DB();
    }

    public function commentsDB($data, $username) {

        $imgLink = $data['imgLink'];
        $comment = $data['comment'];
		$created = date('Y-m-d H:i:s');

        return $this->connectDB->createComments($username, $imgLink, $comment, $created);
        
    }

    public function deleteСommentsDB($idComment, $username) {

        if ($this->connectDB->checkComment($idComment, $username)) {
        
            return $this->connectDB->deleteComment($idComment);
            
        } else {
            return false;
        }
        
    }

    public function deleteImgDB($imgLink, $username) {

        if ($this->connectDB->checkImg($imgLink, $username)) {
        
            return $this->connectDB->deleteImg($imgLink);
            
        } else {

            return false;

        }
        
    }

    public function getCommentsImg($imgLink) {

        return $this->connectDB->getComments($imgLink);

        
    }
    



	}

?>