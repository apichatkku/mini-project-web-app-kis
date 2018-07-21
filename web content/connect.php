<?php
	$pdo = new PDO("mysql:host=localhost;dbname=kis", "root", "");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET NAMES \"utf8\"");
?>
<?php
// ตรวจสอบค่าใน Cookie
	if (isset($_COOKIE["username"])) {
		if($_COOKIE["username"]!=""){
			$username = $_COOKIE["username"]; // ดึงค่าในคุกกี้ที่เคยเขียนไว้ออกมา
			$result = $pdo->query("SELECT * FROM member WHERE username = '$username'");
			$row = $result->fetch();
			$_SESSION["name"] = $row["m_name"]; // สร้าง Session ใหม่อัตโนมัติ
			$_SESSION["username"] = $row["username"];
		}
	}
?>
