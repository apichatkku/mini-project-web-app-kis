<?php	
	
	session_start();
	include "../connect/connect.php";
?>
<?php
	if( !isset($_GET['p_sex']) ){
		$p_sex='all';	
	}else{
		$p_sex=$_GET['p_sex'];
	}
	if( !isset($_GET['p_type']) ){
		$p_type='all';	
	}else{
		$p_type=$_GET['p_type'];
	}
	if( !isset($_GET['p_brand']) ){
		$p_brand='all';	
	}else{
		$p_brand=$_GET['p_brand'];
	}
	

    if($p_sex=='all')
	{
		if($p_type=='all')
		{
			if($p_brand=='all')
			{
				$result = $pdo->query ( "SELECT * FROM product ");
			}
			else{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_brand='$p_brand' " );
			}
		}
		else{
			if($p_brand=='all')
			{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_type='$p_type' ");
			}
			else{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_type='$p_type' AND p_brand='$p_brand' " );
			}
		}
	}
	else{
		if($p_type=='all')
		{
			if($p_brand=='all')
			{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_sex='$p_sex' ");
			}
			else{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_sex='$p_sex' AND p_brand='$p_brand' " );
			}
		}
		else{
			if($p_brand=='all')
			{
				$result = $pdo->query ( "SELECT * FROM product WHERE p_sex='$p_sex' AND p_type='$p_type' ");
			}
			else{
				$result = $pdo->query ( 
				"SELECT * FROM product WHERE p_sex='$p_sex' AND p_type='$p_type' AND p_brand='$p_brand' " );
			}
		}	
	}
?>
<html>

<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="shop.css">


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


	<nav class="sexbar">
        <ul>
        	
           	<li class="sexheader">
            	 เพศ
            </li>
           	<li class=" <?php if($p_sex=='all'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=all" > รวม </a>
            </li>
            <li class=" <?php if($p_sex=='men'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=men" > ชาย </a>
            </li>
            <li class=" <?php if($p_sex=='women'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=women" > หญิง </a>
            </li>
        </ul>
    </nav>
        
    <table width="99%" border="0" cellspacing="0" cellpadding="0" >
   	<tr>
    	<th colspan="2" height="70px" bgcolor="#99CCCC" valign="top" >
        <nav class="typebar">
        <ul>
        	<li class="typeheader">
            	 ประเภท
            </li>
            <li class=" <?php if($p_type=='all'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=all" > รวม </a>
            </li>
           	<li class=" <?php if($p_type=='shirt'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=shirt" > เสื้อ </a>
            </li>
            <li class=" <?php if($p_type=='pants'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=pants" > กางเกง </a>
            </li>
            <li class=" <?php if($p_type=='shoes'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=shoes" > รองเท้า </a>
            </li>
            <li class=" <?php if($p_type=='hat'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=hat" > หมวก </a>
            </li>
            <li class=" <?php if($p_type=='bags'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=bags" > กระเป๋า </a>
            </li>
            <li class=" <?php if($p_type=='watch'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=watch" > นาฬิกา </a>
            </li>
        </ul>
        </nav>
        
        </th>
    </tr>
    <tr>
    
    
    
<!-- ************************************************** ส่วนเมนูแบรนด์ ******************************************************** -->

		<td bgcolor="#FFCC99" width="15%" valign="top">
        <nav class="brandbar">
        <ul>
        	<li class="brandheader">
            	 ยี่ห้อ
            </li>
           	<li class=" <?php if($p_brand=='all'){echo 'active';} ?> ">
            	<a href="shop.php?p_sex=<?php echo $p_sex; ?>&p_type=<?php echo $p_type; ?>&p_brand=all ">รวม</a>
            </li>
            
            
<?php
	if($p_sex=='all'){
		if($p_type=='all'){
			$rsBrand = $pdo->query ( "SELECT DISTINCT p_brand FROM product ORDER BY p_brand");
		}
		else{
			$rsBrand = $pdo->query ( "SELECT DISTINCT p_brand FROM product WHERE p_type = '$p_type' ORDER BY p_brand");
		}
	}
	else{
		if($p_type=='all'){
			$rsBrand = $pdo->query ( "SELECT DISTINCT p_brand FROM product WHERE p_sex='$p_sex' ORDER BY p_brand");
		}else
		{
			$rsBrand = $pdo->query ( "SELECT DISTINCT p_brand FROM product WHERE p_sex='$p_sex' AND p_type = '$p_type' ORDER BY p_brand");
		}
	}
	
	while($colBrand=$rsBrand->fetch()){
		echo  "<li class='";
		if($p_brand==$colBrand['p_brand']){echo "active";}
			echo "'><a href='shop.php?p_sex=".$p_sex."&p_type=".$p_type."&p_brand=".$colBrand['p_brand']."'>".
			$colBrand['p_brand']."</a></li>";
	}
?>

		</ul>
        </nav>
 		       
        
<!-- ************************************************** ส่วนแสดงเมนูย่อย ******************************************************* -->
<td bgcolor="#FFFFFF" width="85%" >
        <!--<div>
        	<a <?php echo 
				"href='shop.php?p_sex=".$p_sex."&p_type=".$p_type."&p_brand=".$colBrand['p_brand']."&order_by=0'"; 
				?>>แสดงสินค้าตาม :</a>
            <select name="orderby">
            	<option>
                <a <?php echo 
				"href='shop.php?p_sex=".$p_sex."&p_type=".$p_type."&p_brand=".$colBrand['p_brand']."&order_by=0'"; 
				?>>
                รหัสสินค้า(ID)</a>
                </option>
                <option>
                <a <?php echo 
				"href='shop.php?p_sex=".$p_sex."&p_type=".$p_type."&p_brand=".$colBrand['p_brand']."&order_by=1'"; 
				?>>
                ราคาถูกไปหาแพง</a>
                </option>
                <option>
                <a <?php echo 
				"href='shop.php?p_sex=".$p_sex."&p_type=".$p_type."&p_brand=".$colBrand['p_brand']."&order_by=2'"; 
				?>>
                ราคาแพงไปหาถูก</a>
                </option>
            </select>
        </div>-->
        
        
<!-- ************************************************** ส่วนแสดงสินค้า ********************************************************* -->
        <?php
$row = $result->rowCount();
if($row!=0){
	echo "<table border='1' cellspacing='60' width='100%'>";
	for($i=1;$col=$result->fetch();$i++){
		if($i==1){echo "<tr>";}
		echo "<td width='33.3%'>" ;
		echo "<a href='showProduct.php?p_id=".$col['p_id']."'>";
		echo "<img src='../images/product/".$col['p_type']."/".$col['p_sex']."/".$col['p_brand']."/".$col['p_id']
		."-1.jpg' width='100%'></a>";
		echo "<hr><div align='left' style='font-size:14px'>รหัสสินค้า : ".$col['p_id']."<br></div>";
		echo "<div align='left' style='font-size:14px'>ยี่ห้อ : ".$col['p_brand']."<br><br></div>";
		echo "<div align='right' style='font-size:16px;color:green;'>Price : ".$col['p_price']." Baht. <br></div>";
		echo "</td>";
		
		if($i==3){
			$i=0;
			echo "</tr>";
		}
	}
	if($row<3){
			for($ri=0;$ri<3-$row;$ri++){
				echo "<td width='33.3%'>" ;
				echo "</td>";
		}
	}
	if($i!=1){echo "</tr>";}
	echo "</table>";
}else{
	echo "";
}
?>
        </td>
    </tr>
    </table>
    
</body>
</html>
