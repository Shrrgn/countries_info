<?php
	interface UserDAO {
		function getUserByName();
		function editUserInfo($password = null, $mail = null);
		function addUser($nickname, $password, $mail);
	}
?>