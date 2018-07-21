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
	
	$result = $pdo->query("SELECT * FROM orders WHERE username  = '$username'");
	
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
    background-color: #f4f4f4;
    }
    </style>
</head>
	
<body>
	<?php require('../main-menu.php')  ?>
<?php

	//ตารางใหญ่
	echo "<br><br><div align='center'><table><tr><td valign='top'>";
	echo "<div align='center' style='font-size:24px;color:darkorange;'>
	รายการสั่งซื้อสินค้า<br></div>";
	
	//ตารางเล็ก โชว์รายการสั่งสินค้า
	echo "</tr><td>";
	echo "<div align='center'><table>";
		echo "<tr height='70'>
		<th><div align='center'>รหัสการสั่งซื้อสินค้า<br>(Order ID)</div></th>
		<th><div align='center'>เวลาที่สั่งสินค้า</div></th>
		<th><div align='center'>สถานะ<br>การโอนเงิน</div></th><th></th><th></th><tr>";
		while($order = $result->fetch()){  // วนลูปรายการสั่งสินค้า	
			echo "<tr>";
			
			echo "<td width='150'><div align='center'>"
			.$order['ord_id']."</div></td>";
			echo "<td width='200' ><div align='center'>".$order['ord_date']."</div></td>";
			echo "<td width='150' ><div align='center'>";
			if($order['status']=='wait'){ echo "รอการโอนเงิน";}
			else if($order['status']=='success'){ echo "โอนเงินแล้ว";}
			echo "</div></td>";
			
			echo "<td width='120'>";
			if($order['status']=='wait'){echo "<a href='upSlip.php?ord_id=".$order['ord_id']."'>แจ้งการโอนเงิน</a>";}
			else{ echo "แจ้งโอนแล้ว";}
			echo "</td>";
			echo "</tr>";
		}
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