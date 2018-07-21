<?php
session_start();
include "../connect/connect.php";


//ทดสอบ $_SESSION['username'] = "Iam";
if(!isset($_SESSION['username'])){
	header("location:../member/login.php");
}
if(!isset($_POST['bank'])){
	header("location:checkOrder.php");
}
?>
<html>
<head><meta charset="utf-8">


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

 <div class="topcart" align="center"><?php include('../main-menu.php') ?></div><br><br><br><br><br><br><br><br>

<?php
	if(isset($_SESSION["cart"])) {
		$additem = $pdo-> exec("INSERT INTO orders VALUES('','".$_SESSION["username"]."', NOW(), 'wait')");
		$ord_id = $pdo->lastInsertId();
		
		$max=count($_SESSION["cart"]); // ดึงจำนวนสินค้าในตะกร้าออกมา
		for($i=0;$i<$max;$i++){ // วนลูปเพื่อเพิ่มรายการสินค้าในตาราง item
			$p_id = $_SESSION["cart"][$i]["p_id"]; // ดึงรหัสสินค้าออกมา
			$qty = $_SESSION["cart"][$i]["qty"];	 // ดึงจำนวนสินค้าออกมา
			$additem = $pdo-> exec("INSERT INTO item VALUES ('', $ord_id,'".$p_id."', $qty)");
		}
		unset($_SESSION["cart"]); // เมื่อการสั่งซื้อเสร็จสิ้น จะทำการลบทุกอย่างออกจากตะกร้า
	
		echo "<div align='center' style='font-size:24px;color:green;'>
		ระบบได้ทำรายการสั่งซื้อสินค้าเรียบร้อยแล้ว ขอขอบคุณที่ใช้บริการค่ะ<br></div>";
		echo "<div align='center' style='font-size:18px;color:green;'>
		คุณเลือก".$_POST['bank']."<br>เลขที่บัญชีคือ 123 - 4 - XXXXX - X
		<br></div>";
		echo "<div align='center' style='font-size:18px;color:red;'>
		***หมายเหตุ***<br>
		กรุณาโอนเงินภายใน 3 วัน และ ยืนยันสถานะการโอนเงินโดยไปที่หน้า \"Order\" เพื่ออัพโหลดรูปใบเสร็จการโอนเงิน<br></div>";
		
	}else{
		echo "<div align='center' style='font-size:24px;color:red;'>
		คุณไม่มีสินค้าที่จะทำรายการสั่งซื้อสินค้า ขอขอบคุณที่ใช้บริการค่ะ<br></div>";
	}
	echo "<br><br><div align='center'><a href='shop.php'><button style='width:120px' type='button' class='btn btn-warning'>
	กลับไปหน้าร้านค้า</button></a>";
	echo " &nbsp; &nbsp; &nbsp; <a href='order.php'><button style='width:120px' type='button' class='btn btn-info'>
	ไปที่หน้า Order</button></a></div>";
?>
</body>
</html>