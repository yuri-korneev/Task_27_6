<?php

namespace App\models;
use App\core\Model;
use App\data\DB;
use App\data\Service;

class Main_model extends Model
{
    public function __construct() {
        $this->connectDB = new DB();
        $this->service = new Service;
    }
    
    public function uploadImages() {

            $input_name = 'file';
            $data = array();
            $files = array();

            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach($_FILES[$input_name] as $k => $l) {
                    foreach($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }		
            }	
        
            foreach ($files as $file) {
                $error = $success = '';
        
                // Проверим на ошибки загрузки
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл';
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл';
                } else {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = mb_eregi_replace($pattern, '-', $file['name']);
                    $name = mb_ereg_replace('[-]+', '-', $name);
                    $parts = pathinfo($name);

                    $pathBig = GALLERY_BIG.$name;
                    $pathSmall = GALLERY_SMALL.$name;
                    $created = date('Y-m-d H:i:s');
                        
                    if (empty($name) || empty($parts['extension']) || in_array($parts['extension'], ALLOWED_TYPES)) { 

                        $error = 'Недопустимый тип файла';

                    } else

                    if (filesize($file['tmp_name']) > UPLOAD_MAX_SIZE) {

                        $error = 'Недопустимый размер файла';

                        } else

                    if ($this->connectDB->checkImageName($pathBig)) {

                        $error = 'Картинка с таким именем уже загружена';
    
                        } 

                    else {
                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], GALLERY_BIG . $name)) {
                            $success = 'Файл «' . $name . '» успешно загружен.';
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                    }
                }

                $userID = $this->connectDB->getUserID($_SESSION['logged_user']->email);
               

                if (!empty($success) && $this->service->img_resize($pathBig, $pathSmall, 200, 200) && $this->connectDB->createImage($userID, $pathBig, $pathSmall, $created)) {

                    $data[] = '<p style="color: green">' . $success . '</p>';  
                }
                if (!empty($error)) {

                    $data[] = '<p style="color: red">' . $error . '</p>';  
                }

            }

            return $data;
        }

        

    }
	


?>