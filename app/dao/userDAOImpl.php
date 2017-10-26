<?php

	require_once 'userDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/dao/db/users_db.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/user.php';

	class UserDAOImpl implements UserDAO {

		function getUser($nick, $password){
			$pdo = new ConnectionDBUsers();

			try{
				$sql = 'SELECT * FROM users WHERE nickname = :nickname AND password = :password';
				$res = $pdo->getPDO()->prepare($sql);
				$res->bindParam(':nickname', $nick, PDO::PARAM_STR);
				$res->bindParam(':password', $password, PDO::PARAM_STR);
				$res->execute();
			}
			catch (PDOException $e) {
				self::db_error('Select user error', $e);
			}
			finally {
				$pdo->destroy_connection();
			}

			$data = $res->fetch();

			$u = new User($data[1]);
			$u->setHashPassword($data[2]);
			$u->setId($data[0]);
			$u->setMail($data[3]);

			return $u;
		}

		function addUser($nickname, $password, $mail){
			$u = new User($nickname, $password);
			$u->setMail($mail);

			$pdo = new ConnectionDBUsers();

			try {
				$sql = 'INSERT INTO users (nickname, password, mail) VALUES 
						:nickname, :password, :mail';
				$res = $pdo->getPDO()->prepare();
				$res->bindParam(':nickname', $u->getNick(), PDO::PARAM_STR);
				$res->bindParam(':password', $u->getPassword(), PDO::PARAM_STR);
				$res->bindParam(':mail', $u->getMail(), PDO::PARAM_STR);
				$res->execute();
			}
			catch (PDOException $e){
				self::db_error('Insert user error', $e);
			}
			finally {
				$pdo->destroy_connection();
			}

			unset($u);

			return true;
		}

		function editUser($nick, $password = null, $mail = null){

		}

		static function db_error($string, $exception){
			$output = $string . $exception->getMessage();
			include 'output.html.php';
			exit();
		}
	}
?>