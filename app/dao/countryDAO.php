<?php
	interface CountryDAO {
		function __construct($country);
		function countryInfo();
		function officialLangs();
		function countryExist();
		function isInTenGNP();
		function isInTenLangs();
	}
?>