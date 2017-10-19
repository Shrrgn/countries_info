<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/country_controller.php';

	$c = new CountryController("Ukraine");
	$c->action_index();

	echo 'Everything ok)';
?>