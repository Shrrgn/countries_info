<?php
	class User {

		function __construct($nick = null, $password = null){
			$this->nick = $nick;
			$this->password = md5($password);
			$this->mail = null;
		}

		function getNick(){
			return $this->nick;
		}

		function setNick($value){
			$this->nick = $value;
		}

		function checkPassword($value){
			return $this->password == md5($value);
		}

		function setPassword($value){
			$this->password = md5($value);
		}

		function setMail($value){
			if (preg_match('^[a-z0-9._]{5,15}@[a-z]{2-7}\.[a-z]{2-3}$', $value)){
				$this->mail = $value;
			}
			else {
				throw new Exception("Invalid user mail", 1);
				
			}
		}

	}
?>