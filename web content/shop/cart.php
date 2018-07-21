<?php
session_start();
include"../connect/connect.php";
?>
<?php
	if(isset($_GET["action"])) {	
	if($_GET["action"]=="add") { // เพิ่มสินค้าลงตะกร้า
		$p_id = $_GET["p_id"];
		$qty = $_GET["qty"];
		addCart($p_id, $qty); // เพิ่มสินค้าตามรหัสสินค้า จำนวน 1 ชิ้น 
	
	} else if($_GET["action"]=="delete") { // ลบสินค้าออกจากตะกร้า
		removeCart($_GET["p_id"]);  // ลบตามรหัสสินค้า
	
	} else if($_GET["action"]=="update") { // ปรับปรุงจำนวนสินค้าแต่ละชิ้นในตะกร้า
		$p_id = $_GET["p_id"];
		$qty = $_GET["qty"];
		updateCart($p_id, $qty); // ปรับปรุงจำนวนตามรหัสสินค้า

	} else if($_GET["action"]=="clear") { // ลบสินค้าทุกอย่างออกจากตะกร้า
		unset($_SESSION["cart"]);
	}
}

// ฟังก์ชันเพิ่มสินค้าลงตะกร้า
function addCart($p_id, $qty) {
	// ถ้ามีตะกร้าสินค้าใน session แล้ว
	if(isset($_SESSION["cart"])) {
		if(productExists($p_id)) return;  // ถ้าสินค้าที่เพิ่มซ้ำกับสินค้าที่มีแล้วในตะกร้า จะไม่เพิ่มใหม่ และออกจากฟังก์ชันนี้
		$max = count($_SESSION["cart"]);  // ดึงเอา index ของอาร์เรย์ช่องสุดท้ายออกมา
		$_SESSION["cart"][$max]["p_id"] = $p_id; // นำรหัสสินค้าไปเก็บ
		$_SESSION["cart"][$max]["qty"] = $qty; // นำจำนวนสินค้าไปเก็บ
		
	// ถ้าไม่มีตะกร้าสินค้าใน session จะสร้างอาร์เร์ยตะกร้าสินค้าใหม่
	} else {
		$_SESSION["cart"] = array();
		$_SESSION["cart"][0]["p_id"] = $p_id; // นำรหัสสินค้าไปเก็บ
		$_SESSION["cart"][0]["qty"] = $qty; // นำจำนวนสินค้าไปเก็บ
	}
} 

// ฟังก์ชันลบสินค้าจากตะกร้า
function removeCart($p_id){
	$max = count($_SESSION["cart"]);  // ดึงจำนวนสินค้าในตะกร้าออกมา
	for($i=0; $i<$max; $i++){ // วนลูปค้นหาตามรหัสสินค้า
		if($p_id==$_SESSION["cart"][$i]["p_id"]) { // ถ้ารหัสสินค้าตรงกัน
			unset($_SESSION["cart"][$i]); // ลบสินค้านั้นออก
			break;
		}
	}
	$_SESSION["cart"] = array_values($_SESSION["cart"]); // สร้างเป็น array ใหม่
}

// ฟังก์ชันปรับปรุงจำนวนสินค้า
function updateCart($p_id, $qty) {
	$max = count($_SESSION["cart"]); // ดึงจำนวนสินค้าในตะกร้าออกมา
	for($i=0; $i<$max; $i++){ // วนลูปอ่านสินค้าแต่ละชิ้นในตะกร้า
		if ($p_id==$_SESSION["cart"][$i]["p_id"]) {
			$_SESSION["cart"][$i]["qty"] = $qty; // ดึงจำนวนสินค้าจากฟอร์มมาเก็บลง session ทับค่าเดิม
		}
	}
}

// ฟังก์ชันตรวจสอบว่ามีสินค้านั้นในตะกร้าแล้วหรือยัง ถ้ามีแล้วจะส่งค่าเป็น 1 ถ้ายังไม่มีส่งค่าเป็น 0
function productExists($p_id){
	$max = count($_SESSION["cart"]);
	$flag = 0;
	for($i=0; $i<$max; $i++){
		if($p_id==$_SESSION["cart"][$i]["p_id"]){
			$flag = 1;
			break;
		}
	}
	return $flag;
}

// ฟังก์ชันขอราคาสินค้า
function getPrice($p_id){
	global $pdo; // ระบุว่าต้องการใช้ตัวแปร global ชื่อ $pdo จาก connect.php
	$result = $pdo->query("SELECT * FROM product WHERE p_id = '$p_id'");
	return $result->fetch();
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ตะกร้าสินค้า</title>

	<link rel="stylesheet" type="text/css" href="cart.css">

	        	<link rel="stylesheet" href="../stylesheet/rsu/specimen_files/specimen_stylesheet.css" type="text/css" charset="utf-8" />
            <link rel="stylesheet" href="../stylesheet/twit/specimen_files/specimen_stylesheet.css" type="text/css" charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>


		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
		<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css"> 
<style type="text/css">
    body{
    background-color: #f4f4f4;
    }
    </style>


	<script>
        function updateQty(qty, p_id) {
            document.location.href = "cart.php?action=update&p_id="+p_id+"&qty="+qty.value;
        }
    </script>
</head>

<body>
<div class="topcart" align="center"><?php include('../main-menu.php') ?></div>

<div id="topcart2">
<?php
	
	echo "<div align='center'>";
	echo "<table border='0' width='1000' height='600' cellspacing='0'><tr>";
	echo "<td width='700'>";
	
	echo "<div class='topcart3'><p class='h'>สินค้าทั้งหมดในตะกร้า</p></div><br>";
	
	if(!isset($_SESSION["cart"])){
		echo "<p class='body1'>ไม่มีสินค้าใดๆในตะกร้าสินค้า!!</p><br></td>";
		
	}
	else{
		echo "<table width='100%'>";
		
		$sum = 0; // ใช้หาผลรวมราคาสินค้าในตะกร้า
		$max = count($_SESSION["cart"]);
		for($i=0; $i<$max; $i++){  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
				$p_id = $_SESSION["cart"][$i]["p_id"];
				$qty = $_SESSION["cart"][$i]["qty"];
				$row = getPrice($p_id);
				$price = $row['p_price'];
				$sum += $price * $qty;
				
		echo "<tr>";
		echo "<td>";
		echo "<img src='../images/product/".$row['p_type']."/".$row['p_sex']."/".$row['p_brand']."/"
		.$row['p_id']."-1.jpg' width='100'>"."</td>";
		echo "<td width='200'>รหัสสินค้า: ".$row['p_id']."</td>";
		echo "<td>จำนวน <select onchange='updateQty(this,\"$p_id\")'>";
				for($j=1; $j<=10; $j++) {
					if ($j == $qty)
						echo "<option value='$j' selected>$j</option>";
					else
						echo "<option value='$j'>$j</option>";
				}
					echo "</select> ชิ้น";
		echo "</td>";
		echo "<td><font color='#3eb514' size='+1'>ราคา ".($price * $qty)." บาท.</font></td>";
		echo "<td><a class='d2' href='cart.php?action=delete&p_id=".$p_id."'>ลบ(Delete)</a></td>";
		echo "</tr>";
		}
		echo "</table><br><br>";
	}
	echo "</td>";
	
	echo "<td valign='top'>";
	if(!isset($_SESSION["cart"])){$sum=0;}
		echo "<div id='topcart4'>";
		echo "<div id='topcart4' class='in'>สรุปรายการสินค้า</div><hr color='#CCCCCC'>";
		echo " <div align='left'><font size='+2'> &nbsp; ราคาสินค้าทั้งหมด</font></div>
		<div align='right'><font color='#3eb514' size='+3'><b>".$sum." บาท. &nbsp; </b></font></div><br>";
		
		echo "<div align='center'><a href='checkOrder.php'>
		<button style='width:100%' type='button' class='btn btn-info'><h2>
		สั่งซื้อสินค้า</h2></button></a></div><br>";
		echo "<a href='cart.php?action=clear'>
		<button style='width:100%' type='button' class='btn btn-danger' >
		ลบรายการสินค้า(CLEAR)</button></a>";
		echo "<a href='shop.php'>
		<button style='width:100%' type='button' class='btn btn-success'><h4>
		เลือกสินค้าเพิ่มเติม</h4></button></a>";
		echo "</div><br><br>";
		
	echo "</td>";
			
	echo "</tr></table>";
	echo "</div>";
?>
</div>
</body>
</html>