<?php 

	require_once 'connection.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

	class ConnectionDBWorld implements Connection {

		use WorldDBSettings;

		function __construct(){
			try {
				$pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db, self::$user, self::$password);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec('SET NAMES "utf8"') ;
			}
			catch (PDOException $e) {
				self::db_error("Couldn't make connection to database: ", $e);
			}
			$this->pdo = $pdo;
		}

		function destroy_connection(){
			unset($this->pdo);
		}

		function getGenerallyCountryInfo($country){
			try {
				$sql = 'SELECT country.Name, city.Name, country.SurfaceArea, country.IndepYear, country.Population,country.GovernmentForm
    						FROM country
    						INNER JOIN city ON country.Code = city.CountryCode
    						WHERE country.Capital = city.ID AND country.Name = :country;';
				$res = $this->pdo->prepare($sql);
				$res->bindParam(':country', $country, PDO::PARAM_STR);
				$res->execute();
			}
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}
			return $res;
		}

		function getOfficialLanguages($country){
			try {
				$sql = 'SELECT countrylanguage.Language
							FROM countrylanguage
    						INNER JOIN country ON countrylanguage.CountryCode = country.Code
    						WHERE country.Name = :country AND countrylanguage.IsOfficial = "T";';
				$res = $this->pdo->prepare($sql);
				$res->bindParam(':country', $country, PDO::PARAM_STR);
				$res->execute();
			}
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}
			return $res;			
		}

		function simpleSelect($sql){
			try {
				$res = $this->pdo->prepare($sql);
				$res->execute();
			}
			catch (PDOException $e) {
				self::db_error('Select data error: ', $e);
			}
			return $res;
		}

		function getTenWithBiggerGNP(){
			$sql = 'SELECT country.Name, country.GNP 
						FROM country 
    					INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode 
    					ORDER BY country.GNP 
    					DESC LIMIT 10;';
    		return $this->simpleSelect($sql);	
		}

		function getTenMostPopularLanguages(){
			$sql = 'SELECT countrylanguage.Language as Lang, COUNT(country.Name) as Quantity 
						FROM country 
    					INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode
    					GROUP BY Lang
    					ORDER BY Quantity DESC
    					LIMIT 10;'
    		return $this->simpleSelect($sql);
		}

		static function db_error($string, $exception){
			$output = $string . $exception->getMessage();
			include 'output.html.php';
			exit();
		}
	}
?>