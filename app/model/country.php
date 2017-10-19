<?php

	class Country {

		function __construct($country_name, $capital, $surface_area, $indep_year, $population, $gov_form){
			$this->country_name = $country_name;
			$this->capital = $capital;
			$this->surface_area = $surface_area;
			$this->indep_year = $indep_year;
			$this->population = $population;
			$this->gov_form = $gov_form;
			$this->offLangs = null;
		}

		function setCapital($value){
			$this->capital = $value;
		}

		function getCapital(){
			return $this->capital;
		}

		function setCountryName($value){
			$this->country_name = $value;
		}

		function getCountryName(){
			return $this->country_name;
		}

		function setSurfArea($value){
			$this->surface_area = $value;
		}

		function getSurfArea(){
			return $this->surface_area;
		}

		function setIndepYear($value){
			$this->indep_year = $value;
		}

		function getIndepYear(){
			return $this->indep_year;
		}

		function setPopulation($value){
			$this->population = $value;
		}

		function getPopulation(){
			return $this->population;
		}

		function setGovForm($value){
			$this->gov_form = $value;
		}

		function getGovForm(){
			return $this->gov_form;
		}

		function setOffCountryLangs($value){
			$this->offLangs = $value;
		}

		function getOffCountryLangs(){
			return $this->offLangs;
		}

	}
?>