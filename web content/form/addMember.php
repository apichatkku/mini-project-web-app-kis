<?php
	include "../connect/connect.php";
		
	$username = $_POST["username"];
	$password = $_POST["password"];
	$m_name = $_POST["p_name"];
	$m_sex = $_POST["p_sex"];
	$address = $_POST["address"];
	$mobile = $_POST["mobile"];
	$email = $_POST["email"];
		
	$pdo->exec("INSERT INTO member VALUES ('$username', '$password', '$m_name','$m_sex','$address','$mobile','user')");
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>เพิ่มสมาชิก</title>
</head>

<body>
	ทำการสมัครสมาชิกเสร็จสิ้น<br>
	ยินดีต้อนรับคุณ <?php echo $m_name ?>
    
</body>
</html>