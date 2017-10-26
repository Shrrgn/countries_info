<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view.php';

	class SigninController {
		function action_index(){
			View::generate('signin.html.php');
		}
	}
?>