<?php
	session_start();
	session_destroy();
	setcookie("username", "", time()-3600);
	header("location:login.php"); // ไปยังหน้า login.php
	exit(0);
?>