<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view.php';

	class RegistrationController {
		function action_index(){
			View::generate('registration.html.php');
		}
	}
?>