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
    background-color: #f4f4f4;
    }
    </style>
</head>
	
<body>
	<?php require('../main-menu.php')  ?>
<?php
	
	//เริ่มตาราง 1
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
	
	//จบตาราง 1
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
		echo "<a href='../form/formaddProduct.php'>ไปยังหน้า Admin</a>";
	}
	
	//ตาราง2 ขวา
	echo "</td><td valign='top'>";
	
	echo
	"
	<form action='editProfile.php' method='POST'>
	<table width='300' border='0' cellspacing='0' cellpadding='0' align='center' class='table'>
	<tr>
			<td width='100px'>ชื่อ-สกุล</td>
			<td width='20px'>:</td>
			<td ><input type='text' name='name' value='$name' class='form-control' placeholder='ชื่อ-สกุล' pattern='[^*^$^+^-^/^=^&^|^\d]+'
			title='ห้ามใส่อักขรพิเศษและตัวเลข' required ></td>
	</tr>
	<tr>
			<td>ที่อยู่ </td>
			<td>:</td>
			<td><textarea class='form-control' name='address' >".$member['address']."</textarea></td>
	</tr>
	<tr>
			<td>เบอร์โทรศัพท์</td>
			<td>:</td>
			<td><input type='text' name='mobile' class='form-control' placeholder='0123456789' pattern='[0-9]{10}' value='".$member['mobile']."'
			title='เฉพาะตัวเลข10ตัว 0800000000'></td>
	</tr>
	<tr>
			<td>E-mail</td>
			<td>:</td>
			<td><input type='email' class='form-control' name='email' value='".$member['email']."'></td>
	</tr>
	<tr>
			<td></td>
			<td>&nbsp;</td>
			<td><input style='width:200;' type='submit' class='btn btn-success' value='ยืนยัน'></td>
	</tr>
		
		</table>
	</form>	
	";
	
	//จบตาราง2
	echo "</td></tr></table></div>";
	
?>

</body>
</html>