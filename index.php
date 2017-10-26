<?php
	/*
	include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/country_controller.php';

	$c = new CountryController("Ukraine");
	$c->action_index();
	*/

	require_once '/app/route.php';
	Route::start();

	echo 'Everything ok)';
?>