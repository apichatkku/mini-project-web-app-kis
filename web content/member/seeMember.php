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
	$user = $result->fetch();
	
	$_SESSION['username']=$user['username'];
	$_SESSION['password']=$user['password'];
	
	if($user['m_state']!='admin'){
		header("location:profile.php");
		exit(0);
	}
	if(!isset($_GET['m_id'])){
		header("location:memberList.php");
		exit(0);
	}
	
	$m_id = $_GET['m_id'];
	$result = $pdo->query("SELECT * FROM member WHERE username  = '$m_id'");
	$member = $result->fetch();
	
?>


<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>ดูข้อมูลผู้ใช้</title>

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
    
<?php

	echo "<br><br><div align='center'>";
	
	if($member['m_img']==''){
		echo "<img src='../images/member/kis.png'";
	}else{
		echo "<img src='../images/member/".$member['m_img']."'";
	}
	echo "width='200' height='200'><br><br>";
	echo "<td><a href='editMember.php?m_id=".$member['username']."'><h3>แก้ไข</h3></a></td>";
	echo "<table width='500'><tr><td width='150' height='40'>ชื่อ </td><td width='20'>:</td><td width='250'>".$member['m_name'];
	echo " </td></tr><tr><td width='150'>Username </td><td width='20'>:</td><td>".$member['username'];
	echo " </td></tr><tr><td width='150'>เพศ </td><td width='20'>:</td><td>".$member['m_sex'];
	echo "</td></tr><tr><td width='150'>ที่อยู่ </td><td width='20'>:</td><td>".$member['address'];
	echo "</td></tr><tr><td width='150'>เบอร์โทรศัพท์ </td><td width='20'>:</td><td>".$member['mobile'];
	echo "</td></tr><tr><td>E-mail </td><td width='20'>:</td><td>".$member['email'];
	echo "</td></tr><tr><td>คะแนน </td><td width='20'>:</td><td>".$member['m_score'];
	echo "</td></tr><tr><td>เหรียญทอง <img src='../images/etc/gdCoin.png' width='30'> 
	</td><td width='20'>:</td><td>".$member['m_gd'];
	echo "</td></tr><tr><td>เหรียญเงิน <img src='../images/etc/svCoin.png' width='30'>
	</td><td width='20'>:</td><td>".$member['m_sv'];
	echo "</td></tr><tr><td></td><td></td></tr><tr><td></td><td></td><td><a href='memberList.php'><button style='width:100%;'class='btn btn-warning'>back to management</button></a></td></tr></table>";
	
?>

</body>
</html>