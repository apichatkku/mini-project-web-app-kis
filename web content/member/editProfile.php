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
	<meta charset="utf-8"></head>
    <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
			
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css">
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
	echo "<a href='#'>แก้ไขข้อมูล</a><br>";
	echo "<a href='#'>ดูรายการสั่งซื้อสินค้า</a><br>";
	
	//ตรวจรายการสินค้าที่รอชำระ
	$result = $pdo->query("SELECT count(*) FROM orders WHERE username  = '$username' AND status = 'wait' ");
	$order = $result->fetch();
	
	echo "( ".$order['count(*)']." รายการ ที่ไม่ได้ชำระเงิน )<br>";
	
	if($member['m_state']=='admin'){
		echo "<a href='../form/formaddProduct.php'>ไปยังหน้า Admin</a>";
	}
	
	//ตาราง2 ขวา
	echo "</td><td valign='top'>";
	
	if(isset($_POST['name'])){
		$name = $_POST["name"];
		$address = $_POST["address"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		$pdo->exec("UPDATE member SET m_name='$name' , address='$address' , mobile='$mobile' , email='$email' 
		WHERE username = '$username' ");
	}
	header("location:profile.php");
	exit(0);
	
	//จบตาราง2
	echo "</td></tr></table></div>";
	
?>
	
</body>
</html>