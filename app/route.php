<?php
	class Route {
		static function start(){
			$controller_name = 'Main';
			$controller_action = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);
			var_dump($routes);

			if (!empty($routes[1])){
				$controller_name = $routes[1];
			}

			if (!empty($routes[2])){
				$controller_action = $routes[2];
			}

			$controller_class = $controller_name . 'Controller';
			$controller_action = 'action_' . $controller_action;

			$controller_file = strtolower($controller_name) . '_controller.php';
			$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $controller_file;


			if (file_exists($controller_path)){
				include $controller_path;
			}
			else {
				throw new Exception("File doesn't exist", 1);
				
			}

			$controller = new $controller_class;

			if (method_exists($controller, $controller_action)){
				$controller->$controller_action();
			}
			else {
				throw new Exception("Method doesn't exist", 1);
				
			}
			
		}
	}
?>