<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/dao/countryDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/dao/db/db_world.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/country.php';

	class CountryDAOImpl implements CountryDAO {

		function __construct($country){
			$this->country = $country;
		}

		function getData(){
			$info = $this->countryInfo();
			$c = new Country($info[0], $info[1], $info[2], $info[3], $info[4], $info[5]);
			$c->setOffCountryLangs($this->officialLangs());
			return $c;
		}

		function countryInfo(){
			$pdo = new ConnectionDBWorld();
			
			try {
				$sql = 'SELECT country.Name, city.Name, country.SurfaceArea, country.IndepYear, country.Population,country.GovernmentForm
    						FROM country
    						INNER JOIN city ON country.Code = city.CountryCode
    						WHERE country.Capital = city.ID AND country.Name = :country;';
				$res = $pdo->getPDO()->prepare($sql);
				$res->bindParam(':country', $this->country, PDO::PARAM_STR);
				$res->execute();
			}
			
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e); // rewrite in future
			}

			finally {
				$pdo->destroy_connection();
			}
			
			return $res->fetch();
		}

		function officialLangs(){
			$pdo = new ConnectionDBWorld();

			try {
				$sql = 'SELECT countrylanguage.Language
							FROM countrylanguage
    						INNER JOIN country ON countrylanguage.CountryCode = country.Code
    						WHERE country.Name = :country AND countrylanguage.IsOfficial = "T";';
				$res = $pdo->getPDO()->prepare($sql);
				$res->bindParam(':country', $country, PDO::PARAM_STR);
				$res->execute();
			}
			
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}

			finally {
				$pdo->destroy_connection();
			}

			return $res->fetchAll();
		}

		function countryExist(){

		}

		function isInTenGNP(){
			$pdo = new ConnectionDBWorld();

			try {
				$sql = 'SELECT country.Name, country.GNP 
						FROM country 
    					INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode 
    					ORDER BY country.GNP 
    					DESC LIMIT 10;';
				$res = $pdo->getPDO()->prepare($sql);
				$res->execute();
			}
			
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}

			finally {
				$pdo->destroy_connection();
			}

			return self::checkCountries($res, $this->country);
		}

		function isInTenLangs(){
			$pdo = new ConnectionDBWorld();

			try {
				$sql = 'SELECT countrylanguage.Language as Lang, COUNT(country.Name) as Quantity 
						FROM country 
    					INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode
    					GROUP BY Lang
    					ORDER BY Quantity DESC
    					LIMIT 10;';
				$res = $pdo->getPDO()->prepare($sql);
				$res->execute();
			}
			
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}

			finally {
				$pdo->destroy_connection();
			}

			return self::checkCountries($res, $this->country);	
		}

		static function checkCountries($arr, $country){
			while ($i = $arr->fetchAll()){
				if ($i[0] == $country){
					return true;
				}
			}

			return false;			
		}
	}
?>