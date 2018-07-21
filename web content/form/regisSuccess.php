<?php
	include "../connect/connect.php";
	session_start();//start session
 	ob_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>สถานะการลงทะเบียน</title>

	<link rel="stylesheet" href="../stylesheet/rsu/specimen_files/specimen_stylesheet.css" type="text/css" charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
	

    <link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>

<style type="text/css">
    body{
    background-color: #e9eaed;
    }
    </style>
</head>

<body>
	<div class="main3">
  <?php require("../main-menu.php") ?>
</div><br><br>
	<?php
		if(isset($_SESSION['regisSuccess'])){
        	echo "<div><p align='center' style='color:green;font-size:25px;'>ยินดีด้วย!!!</p>
			<p align='center' style='color:green;font-size:18px;'>คุณทำการสมัครสมาชิกสำเร็จเรียบร้อย";
        	echo "ยินดีต้อนรับคุณ ".$_SESSION['m_name']."</p><br>
        	<div  align='center'><a href='../member/login.php'>
		<input class='btn btn-success' type='submit' value='Go to login'></a></div></div>";
			unset($_SESSION['regisSuccess']);
			unset($_SESSION['m_name']);

    	}else{
			header("location:../member/login.php");
			exit(0);
		}
	?>
    
</body>
</html>