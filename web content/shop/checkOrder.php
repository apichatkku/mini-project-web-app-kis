<?php
session_start();
	include "../connect/connect.php" ;
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">


	<link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>


	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css"> 
    

<style type="text/css">
    body{
    background-color: #f4f4f4;
    }
    </style>
</head>
<body>

  <div class="topcart" align="center"><?php include('../main-menu.php') ?></div><br><br>

<?php
	if (empty($_SESSION['username'])&&empty($_SESSION['name'])) {
		echo "<div align='center' style='font-size:24px;' >กรุณาทำการ <a href='../form/formRegister.php'>สมัครสมาชิก</a>";
		echo " หรือ "; 
		echo "<a href='../member/login.php'>Login</a> เพื่อเข้าสู่ระบบ<br>";
		echo "ก่อนทำการสั่งซื้อสินค้าค่ะ</div>";
	} else if(isset($_SESSION['cart'])) {
		
		echo "<div align='center' ><table height='300' width='400' ><tr><td bgcolor='#FFCCCC'>";
		echo "<div align='center' style='font-size:24px;'>กรุณาเลือกธนาคาร<br><br>";
		echo "<form action='createOrder.php' method='post'><select name='bank' required>";
		echo "<option value='ธนาคารกรุงเทพ'>ธนาคารกรุงเทพ</option>";
		echo "<option value='ธนาคารกรุงศรีอยุธยา'>ธนาคารกรุงศรีอยุธยา</option>";
		echo "<option value='ธนาคารกสิกรไทย'>ธนาคารกสิกรไทย</option>";
		echo "<option value='ธนาคารออมสิน'>ธนาคารออมสิน</option>";
		echo "<option value='ธนาคารไทยพาณิชย์'>ธนาคารไทยพาณิชย์</option>";
		echo "</select><br>";
		
		echo "<button type='submit' style='color:#Fff;background-color:#09dc8a;border-color:green;'>
		ยืนยัน</button>";
		echo " &nbsp; &nbsp; &nbsp; <a href='cart.php'>
		<button style='color:#Fff;background-color:#F00;border-color:darkred;'>
		ยกเลิก</button></a></div>";
		echo "</td></tr></table></div>";
	} else{
		echo "<div align='center' style='font-size:24px;'>คุณไม่มีสินค้าในตระกร้า<br>";
		echo "<a class='b1' href='shop.php'><button  style='width:120px' type='button' class='btn btn-warning'>
		กลับไปหน้าร้านค้า</button></a></div>";
	}
?>

</body>
</html>