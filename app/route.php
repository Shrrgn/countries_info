<?php
	class Route {
		static function start(){
			$controller_name = 'Main';
			$controller_action = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);
			var_dump($routes);
			
		}
	}
?>