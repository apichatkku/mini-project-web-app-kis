<?php 
session_start();
include "../connect/connect.php";
	
	
	if(!isset($_SESSION['username'])){
		header("location:../member/login.php");
		exit(0);
	}
	
	$username=$_SESSION['username'];
	$name=$_SESSION['name'];
	$result = $pdo->query("SELECT * FROM member WHERE username  = '$username'");
	$member = $result->fetch();
	
	if(!isset($_GET['ord_id'])){
		header("location:order.php");
		exit(0);
	}
	
	$result = $pdo->query("SELECT count(*) FROM orders WHERE username  = '$username'
	AND ord_id  = '".$_GET['ord_id']."' AND status = 'wait'");
	$order = $result->fetch();
	if($order['count(*)']==0){
		header("location:order.php");
		exit(0);
	}
	
?>

<html>
<head>
	<meta charset="utf-8">
    
    
    <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css">

<style type="text/css">
    body{
    background-color: #e9eaed;
    }
    </style>
	</head>
<body>
	<?php require('../main-menu.php')  ?>
<?php

	//ตารางใหญ่
	echo "<br><br><div align='center'><table><tr><td valign='top'>";
	echo "<div align='center' style='font-size:24px;color:darkorange;'>
	อัพรูปใบเสร็จการโอนเงินของคุณ<br></div>";
	
	
	echo "</tr><td>";
	//ตารางเล็ก โชว์รายการสั่งสินค้า
	echo "<div align='center'><table>";
	
	//ฟอร์มอัพรูป
	echo "<form action='checkSlip.php' method='POST' enctype='multipart/form-data'>";
	echo "<label for='file'>File Name</label>";
	echo "<input type='file' name='file' id='file'><br>";
	echo "<input type='text' name='ord_id' value='".$_GET['ord_id']."' hidden='on'>";
	echo "<button type='submit' style='width:120px' type='button' class='btn btn-success'>
		เสร็จสิ้น</button>";
	echo "</form>";
		
	//ปิดตารางเล็ก
	echo "</table></div>";
	
	echo "<div align='center'><table><tr>";
	echo "<br>";
	echo "<td><a href='shop.php'><button style='width:120px' type='button' class='btn btn-warning'>
กลับไปหน้าร้านค้า</button></a></td>";
	echo "</tr></table></div>";
	
	//ปิดตารางใหญ่
	echo "</td></tr></table></div>";
	
	
?>
	
</body>
</html>