<?php 
session_start();
include "../connect/connect.php";
	
	
	if(!isset($_SESSION['username'])){
		header("location:login.php");
		exit(0);
	}
	
	$username=$_SESSION['username'];
	$name=$_SESSION['name'];
	$result = $pdo->query("SELECT * FROM member WHERE username  = '$username'");
	$member = $result->fetch();
	
	$_SESSION['username']=$member['username'];
	$_SESSION['password']=$member['password'];
	
?>

<html>
<head>
	<meta charset="utf-8">

	    <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
			
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    
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

	echo "<br><br><div align='center'><table border='0' width='1000' height='200'><tr><td width='200'>";
	if($member['m_img']==''){
		echo "<img src='../images/member/kis.png'";
	}else{
		echo "<img src='../images/member/".$member['m_img']."'";
	}
	echo "width='200' height='200' ></td><td width='500'>";
	if($member['m_state']=='admin'){ echo "Admin<br>";}
	echo "คุณ ".$member['m_name']."<br>";
	echo "( ".$member['username']." )<br>";
	
	echo "<td><div align='right'>";
	echo "คะแนน ".$member['m_score']."<br>";
	echo "เหรียญทอง "."<img src='../images/etc/gdCoin.png' width='30'> ".$member['m_gd']."<br>";
	echo "เหรียญเงิน "."<img src='../images/etc/svCoin.png' width='30'> ".$member['m_sv']."</div><br>";
	echo "</td></tr></table></div>";
	
	//ตาราง2 ซ้าย
	echo "<br><br><div align='center'><table border='0' width='1000' height='200'><tr><td width='300' valign='top'>";
	echo "<a href='editImg.php'>แก้ไขรูปภาพ</a><br>";
	echo "<a href='formEditProfile.php'>แก้ไขข้อมูล</a><br>";
	echo "<a href='../shop/order.php'>ดูรายการสั่งซื้อสินค้า (order)</a><br>";
	
	//ตรวจรายการสินค้าที่รอชำระ
	$result = $pdo->query("SELECT count(*) FROM orders WHERE username  = '$username' AND status = 'wait' ");
	$order = $result->fetch();
	
	echo "( ".$order['count(*)']." รายการ ที่ยังไม่ได้โอนเงิน )<br>";
	
	if($member['m_state']=='admin'){
		echo "<a href='addmin.php'>ไปยังหน้า Admin</a>";
	}
	
	//ตาราง2 ขวา
	echo "</td><td valign='top'>";

		echo "<table width='400'><tr><td width='130'>ชื่อ </td><td width='20'>:</td><td width='250'>".$member['m_name'];
	 echo " </td></tr><tr><td width='150'>เพศ </td><td width='20'>:</td><td>".$member['m_sex'];
	echo "</td></tr><tr><td width='150'>ที่อยู่ </td><td width='20'>:</td><td>".$member['address'];
	echo "</td></tr><tr><td width='150'>เบอร์โทรศัพท์ </td><td width='20'>:</td><td>".$member['mobile'];
	echo "</td></tr><tr><td>E-mail </td><td width='20'>:</td><td>".$member['email'];
		echo "</td></tr></table>";
	echo "</td></tr></table></div>";
	
?>
</body>
</html>