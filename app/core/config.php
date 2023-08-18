<?php

namespace App\core;

define('ROOT', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
define("DB_HOST", "localhost");

define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('CORE', APP . 'core' . DIRECTORY_SEPARATOR);
define('DATA', APP . 'data' . DIRECTORY_SEPARATOR);
define('MODEL', APP . 'models' . DIRECTORY_SEPARATOR);
define('VIEW', APP . 'views' . DIRECTORY_SEPARATOR);
define('CONTROLLER', APP . 'controllers' . DIRECTORY_SEPARATOR);

define('UPLOAD_MAX_SIZE', 4000000);
define('ALLOWED_TYPES', ['jpeg', 'jpg', 'png', 'gif']);

define('GALLERY_BIG', 'gallery_big' . DIRECTORY_SEPARATOR);
define('GALLERY_SMALL', 'gallery_small' . DIRECTORY_SEPARATOR);

?>