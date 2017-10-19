<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/dao/countryDAOImpl.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view.php';

	class CountryController {

		function __construct($country){
			$this->model = new CountryDAOImpl($country);
		}

		function action_index(){
			$c_info = $this->model->getData();

			$generally = array($c_info->getCountryName(), $c_info->getCapital(), $c_info->getSurfArea(), $c_info->getIndepYear(),
								$c_info->getPopulation(), $c_info->getGovForm());

			View::generate('country_info.html.php', compact("generally"));	
		}
	}
?>