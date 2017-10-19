<?php 

	require_once 'db.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/config/config.php';

	class ConnectionDBWorld implements ConnectionDB {

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

		function getPDO(){
			return $this->pdo;
		}
		
		static function db_error($string, $exception){
			$output = $string . $exception->getMessage();
			include 'output.html.php';
			exit();
		}
	}
?>