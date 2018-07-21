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
	
?>

<!doctype html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device‐width, initial‐scale=1, maximum‐scale=1">


<title>DataFormLogin</title>

<link rel="stylesheet" media="screen"  href="../css/bootstrap.min.css">
<link href="../css/fonts/thsarabunnew.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
			
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
	<link rel="stylesheet" type="text/css" href="../stylesheet/main-head.css">

<style>
	
	body,td,th {
			font-family: 'THSarabunNew', sans-serif;
				}
	
	body{
		background-color:#f2f2f2;
		}
		p{
			font-size:24px
		}
		.a{
			margin-top:50px;
			}
		.article {
			border: solid 1px black;
			float: left;
			width: 330px;
			}
			.aside {
			border: solid 1px black;
			position: absolute;
			float: left;
			background: pink;
			margin-left: 350px;
			}
			@media (max-width : 480px) {
			.article {
			float: none;
			width: auto;
			}
			.aside {
			background: pink;
			margin-left: 1px;
			}
			}
</style>
</head>
<body>
  <?php require('../main-menu.php')  ?>
<center>
 <br><br><br>
            <table width="350" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
              <tr>
                <td>
                
<?php
	if($_FILES["file"]["error"]){
		echo "<br><div align='center' style='font-size:24px;color:red;'>Error !! ไม่สามารถอัพโหลดไฟล์ได้ หรือ ไฟล์ไม่มีอยู่จริง</div>";
	
	}
	else{
		/*echo "Upload: ".$_FILES["file"]["name"]."<br>";
		echo "Type: ".$_FILES["file"]["type"]."<br>";
		echo "Size: ".($_FILES["file"]["size"]/1024)."Kb. <br>";
		echo "Stored in: ".$_FILES["file"]["tmp_name"]."<br>";*/
		$f_type = $_FILES["file"]["type"];
		$f_name = "";
		if(($_FILES["file"]["size"]/1024)>100){
			echo "<div align='center' style='font-size:24px;color:red;'>
			Error !! ไฟล์มีขนาดใหญ่เกินไป ขนาดไฟล์ต้องไม่เกิน 100 Kb <br></div>";
		}
		if($f_type=="image/x-png"||$f_type=="image/png"){$f_name="$name.png";}
		else if($f_type=="image/pjpeg"||$f_type=="image/jpeg"||$f_type=="image/jpg"){$f_name="$name.png";}
		else if($f_type=="image/gif"){$f_name="$name.png";}
		else{ echo "<div align='center' style='font-size:24px;color:red;'>อัพโหลดได้เฉพาะไฟล์ .png , .jpg , .gif เท่านั้น !!</div>";}
		if($f_name!=""){
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/member/".$f_name);
			$pdo->exec("UPDATE member SET m_img='$f_name' WHERE username = '$username'");
			echo "<div align='center'>รูปของคุณอัพโหลดเรียบร้อยแล้วค่ะ<br><br>";
			echo "<img src='../images/member/".$member['m_img']."'></div>";
		}
	}
?>
<br><br><br>
<div align="center">
<a href='editImg.php'><button style='width:100%;'class='btn btn-warning'>กลับไปหน้าอัพโหลดรูป</button></a>
<a href='profile.php'><button style='width:100%;'class='btn btn-info'>ไปที่หน้า Profile</button></a>
</div>
                
                
                </td>
              </tr>
            </table>
</div></center>

</body>
</html>