<?php
	interface UserDAO {
		function getUser($nick, $password);
		function editUserInfo($nick, $password = null, $mail = null);
		function addUser($nickname, $password, $mail);
	}
?>