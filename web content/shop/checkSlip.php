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
	
	if(!isset($_POST['ord_id'])){
		header("location:order.php");
		exit(0);
	}
	
	$ord_id = $_POST['ord_id'];
	
	$result = $pdo->query("SELECT count(*) FROM orders WHERE username  = '$username' AND ord_id  = '$ord_id' AND status = 'wait'");
	$order = $result->fetch();
	if($order['count(*)']==0){
		header("location:order.php");
		exit(0);
	}
	
	$result = $pdo->query("SELECT * FROM orders WHERE username  = '$username' AND ord_id = '$ord_id' AND status = 'wait' ");
	$order = $result->fetch();
	
	$result = $pdo->query("SELECT item.quantity , product.p_price FROM item JOIN product
	WHERE item.ord_id='".$order['ord_id']."' AND product.p_id=item.p_id ");
	
	//คำนวนราคาไอเทมใน Order ครั้งนี้
	$sumPrice=0;
	while($item = $result->fetch()){
		$price = $item['quantity']*$item['p_price'];
		$sumPrice += $price ;
	}
	
?>

<html>
<head>
	<meta charset="utf-8"></head>
    
    
    <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css">
<body>
	<?php require('../main-menu.php')  ?>
	<br><br>
	<?php

if($_FILES["file"]["error"]){
	echo "<div align='center' style='font-size:24px;color:red;'>Error !! ไม่สามารถอัพโหลดไฟล์ได้ หรือ ไฟล์ไม่มีอยู่จริง<br></div>";
}
else{
	/*ดูข้อมูลไฟล์รูป
	echo "Upload: ".$_FILES["file"]["name"]."<br>";
	echo "Type: ".$_FILES["file"]["type"]."<br>";
	echo "Size: ".($_FILES["file"]["size"]/1024)."Kb. <br>";
	echo "Stored in: ".$_FILES["file"]["tmp_name"]."<br>";
	*/
	
	$pdo->exec("UPDATE member SET m_score=$sumPrice WHERE username = '$username'");
	
	$pdo->exec("UPDATE orders SET status='success'
	WHERE username = '$username' AND ord_id = '$ord_id' ");

	echo "<div align='center' style='font-size:24px;color:red;'>คุณได้รับคะแนน ".$sumPrice."<br></div>";
	echo "<div align='center' style='font-size:24px;color:green;'>อัพโหลดรูปใบเสร็จโอนเงินสำเร็จ<br></div>";

}

echo "<br><br><div align='center'><a href='shop.php'><button style='width:120px' type='button' class='btn btn-warning'>
กลับไปหน้าร้านค้า</button></a>";
echo " &nbsp; &nbsp; &nbsp; <a href='order.php'><button style='width:120px' type='button' class='btn btn-info'>
ไปที่หน้า Order</button></a></div>";


?>
	
	
?>
	
</body>
</html>