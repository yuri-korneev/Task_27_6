<?php

namespace App\core;

define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');
define('MODELS_NAMESPACE', 'App\\models\\');

class Route
{
	public static function start()
	{
		$controllerClassname = 'main';
        $action_name = 'index';
		$payload = [];
		
		$routes = explode("/", $_SERVER["REQUEST_URI"]);
		
		if ( !empty($routes[1]) )
		{	
			$controllerClassname = $routes[1];
		}

		if ( !empty($routes[2]) )
		{	
			$action_name = $routes[2];
		}

		if ( !empty($routes[3]) ) {
		$payload = array_slice($routes, 3);
		}


		$controller_name = CONTROLLERS_NAMESPACE . ucfirst($controllerClassname);
		$model_name = MODELS_NAMESPACE . ucfirst($controllerClassname);

		$controllerFile = ucfirst(strtolower($controllerClassname)) . '.php';
		$modelFile = ucfirst(strtolower($controllerClassname)) . '.php';

		$controller_path = CONTROLLER . $controllerFile;
		$model_path = MODEL . $modelFile;

		if(file_exists($model_path))
		{
			include_once $model_path;
		}

		if(file_exists($controller_path))
		{
			include_once $controller_path;
		}
		else
		{
			echo 'controller';
		    Route::ErrorPage404();
		}

		$controller = new $controller_name();
		$method = $action_name;

		if(method_exists($controller, $method))
		{
			$controller->$method();
		}
		else
		{
			echo 'method';
		    Route::ErrorPage404();
		}
	}

	public static function ErrorPage404()
	{
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
			header('Location:/error');
	}

}

?>