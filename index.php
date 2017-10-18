<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/app/dao/countryDAOImpl.php';

	$c = new CountryDAOImpl("Ukraine");
	echo $c->countryInfo();

	echo 'Everything ok)';
?>