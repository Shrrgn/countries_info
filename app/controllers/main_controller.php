<?php
	
	require_once $_SERVER['REQUEST_URI'] . '/app/view.php';

	class MainController {
		function action_index(){
			View::generate('main.html.php');
		}
	}
?>