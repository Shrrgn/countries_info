<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view.php';

	class MainController {
		function action_index(){
			View::generate('main.html.php');
		}
	}
?>