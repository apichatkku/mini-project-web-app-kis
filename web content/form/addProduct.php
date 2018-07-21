<?php
	include "../connect/connect.php";
		
	$p_id = $_POST["p_id"];
	$p_type = $_POST["p_type"];
	$p_brand = $_POST["p_brand"];
	$p_title = $_POST["p_title"];
	$p_price = $_POST["p_price"];
	$p_sex = $_POST["p_sex"];
	$p_numimage = $_POST["p_numimage"];
		
	$pdo->exec("INSERT INTO product VALUES ('$p_id', '$p_type', '$p_brand','$p_title','$p_price','$p_sex',$p_numimage)");
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>เพิ่มสินค้า</title>
</head>

<body>
	<p style="color:#090;">
	เพิ่มสินค้า รหัส: <?php echo $p_id; ?><br>
    ประเภท: <?php echo $p_type; ?><br>
    ยี่ห้อ : <?php echo $p_brand; ?><br>
    คำอธิบาย : <?php echo $p_title; ?><br>
    ราคา : <?php echo $p_price; ?><br>
    สำหรับ : <?php echo $p_sex; ?><br>
    จำนวนรูปภาพ : <?php echo $p_numimage; ?><br>
    </p>
    <a href="addProduct.html"><<กลับไปหน้าเพิ่มสินค้า</a>
</body>
</html>