<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/model/db/db_world.inc.php';

	class Country {

		function __construct($country){
			$this->country = $country;
			$this->connection = new ConnectionDBWorld();
		}

		function generallyInfo(){
			return $this->connection->getGenerallyCountryInfo($this->country);
		}

		function offLangs(){
			return $this->connection->getOfficialLanguages($this->country);
		}

		function isItHaveBiggestGNP(){                              
			$data = $this->connection->getTenWithBiggestGNP();
			
			foreach ($data as $i) {
				if ($i[0] == $this->country){
					return array($i[0], $i[1]);
				}
				else {
					return array();
				}
			}
		}

	}
?>