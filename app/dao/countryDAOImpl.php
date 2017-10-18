<?php
	
	require_once 'countryDAO.php';
	require_once '/db/db_world.inc.php';

	class CountryDAOImpl implements CountryDAO {

		function __construct($country){
			$this->country = $country;
		}

		function countryInfo(){
			$pdo = new ConnectionDBWorld();
			
			try {
				$sql = 'SELECT country.Name, city.Name, country.SurfaceArea, country.IndepYear, country.Population,country.GovernmentForm
    						FROM country
    						INNER JOIN city ON country.Code = city.CountryCode
    						WHERE country.Capital = city.ID AND country.Name = :country;';
				$res = $pdo->prepare($sql);
				$res->bindParam(':country', $this->country, PDO::PARAM_STR);
				$res->execute();
			}
			
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}
			
			return $res->fetch_assoc();
		}
	}
?>