<?php
	session_start();
	include "../connect/connect.php";
?>
<?php
	$p_id=$_GET["p_id"];
	 
	$result = $pdo->query ( "SELECT * FROM product WHERE p_id='$p_id' ");
	$row = $result->fetch();
?>
<html>

<head>
	<meta charset="utf-8">
    <style>
				/* unvisited link */
		a:link {
			color: #2FC4B5;
			text-decoration:none;
		}
		
		/* visited link */
		a:visited {
			color: #2FC4B5;
		}
		
		/* mouse over link */
		a:hover {
			color: pink;
		}
		
		/* selected link */
		a:active {
			color: black;
			background-color: pink;
		}
		img.imgbg{
			position: absolute;
			align-left: 0px;
			align-top: 0px;
			z-index: -1;
		}
	</style>
    
    <script src="showProduct.js"></script>
    <script>
	var iImg;
    	function swapImage(iImg){
			<?php
			echo "
			document.getElementById('imgShowProduct').src =
			'../images/product/".$row['p_type']."/".$row['p_sex']."/".$row['p_brand']."/".$row['p_id']."-'+iImg+'.jpg';
			";
			?>
		}
    </script>


    	        	
            
            <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>


		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
		<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css"> 



</head>

<body>

   <div class="topcart" align="center"><?php include('../main-menu.php') ?></div><br><br>
         
<?php
	echo "<table border='0'><tr>";
	echo "<th> สินค้า <a href='shop.php?p_sex=".$row['p_sex']."'>";
	if($row['p_sex']=='men'){echo "ชาย";}
	else if($row['p_sex']=='women'){echo "หญิง";}
	echo "</th></a>";

	echo "<th> <img  src='../images/etc/cursorlabel.png' height='20'>
	&nbsp; ประเภท <a href='shop.php?p_type=".$row['p_type']."'>";
	if($row['p_type']=='hat'){echo "หมวก";}
	else if($row['p_type']=='shirt'){echo "เสื้อ";}
	else if($row['p_type']=='bags'){echo "กระเป๋า";}
	else if($row['p_type']=='watch'){echo "นาฬิกา";}
	else if($row['p_type']=='pants'){echo "กางเกง";}
	else if($row['p_type']=='shoes'){echo "รองเท้า";}
	echo "</th></a>";
	
	echo "<th> <img  src='../images/etc/cursorlabel.png' height='20'>
	&nbsp; ยี่ห้อ <a href='shop.php?p_brand=".$row['p_brand']."'>".$row['p_brand']."</a></th>";
	
	echo "</tr></table><br><br>";
	
	//ตารางโชว์สินค้า
	echo "<div align='center'><table border='0' width='1000' height='600' cellpadding='5' cellspacing='0' ><tr>";
	
	//ช่องโชว์รูปเล็ก
	echo "<td width='70' valign='top'><table bolder='1' bordercolor='silver' bgcolor='silver' cellspacing='0' >";
	for($i=1;$i<=$row['p_numimage'];$i++){
		echo "<tr><td><img src='../images/product/".$row['p_type']."/".$row['p_sex']."/".$row['p_brand']."/".$row['p_id']
		."-".$i.".jpg' width='100%' onClick=\"(swapImage('$i'))\" ></td></tr>";
	}
	
	//ช่องโชว์รูปใหญ่
	echo "</table></td><td width='415'>";
	
	echo "<img src='../images/product/".$row['p_type']."/".$row['p_sex']."/".$row['p_brand']."/".$row['p_id']
	."-1.jpg' width='100%' id='imgShowProduct'>";
	
	//ช่องโชว์รายระเอียด
	echo "</td><td valign='top' >";
	
	echo "<br><font size='+1'>&nbsp; รหัสสินค้า : ".$row["p_id"]."</font><br><hr color='#CCCCCC'>";
	
	echo "<dl><dt><font color='#3399CC' size='+3' >รายระเอียดสินค้า</font></dt>";
	echo "<dd><font color='#333333' size='+2' >".$row['p_title']."</font></dd></dl><hr color='#CCCCCC'><br>";
	
	echo "<table border='0'><tr><td width='200'>
	&nbsp; <img class='imgbg'  src='../images/etc/pricelabel.png' width='150'>
	<font color='#FFFFFF' size='+3' >&nbsp;Price</font><br>
	<font color='#FFFFFF' size='+3'>&nbsp; ราคา</font></td>";
	echo "<td><font color='#09dc8a' size='+6' ><b>".$row['p_price']." Baht.</b></font></td></tr></table><br><br>
	<hr color='#CCCCCC'><br>";
	
	//ฟอร์มระบุจำนวนสินค้า
	echo "<form action='cart.php' method='get'>";
	echo "<input type='text' value='add' name='action' hidden='on'>";
	echo "<input type='text' value='".$row['p_id']."' name='p_id' hidden='on'>";
	
	echo "<font color='#333333' size='+2' >จำนวน 
	<input type='number' value='1' max='10' min='1' name='qty' id='qty'
	onKeyUp='updatePrice(".$row['p_price'].")' onClick='updatePrice(".$row['p_price'].")' > ชิ้น</font>";
	
	echo " &nbsp; &nbsp; <button type='submit' style='background-color:red; border-color:darkred;' >
	<font size='+3' color='#ffffff'>หยิบใส่ตะกร้า</font></button>";
	echo "</form>";
	echo "<font color='#999999'>ราคา <span id='price'>".$row['p_price']."</span> บาท</font>";
	
	//จบตารางโชว์สินค้า
	echo "</td></tr></table></div>";
	
	
?>



</body>
</html>