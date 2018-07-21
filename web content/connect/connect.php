<?php
	$pdo = new PDO("mysql:host=localhost;dbname=958986", "958986", "helloComdet");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET NAMES \"utf8\"");
?>
