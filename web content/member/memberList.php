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
		<?php require('../main-menu.php')  ?><br><br><br>
<?php
	$result = $pdo->query("SELECT * FROM member ORDER BY username");
	echo "<div align='center'><table ><tr>
	<th >รูป</th>
	<th width='200' >Username</th>
	<th width='200' >Full Name</th>
	<th width='100' >Sex</th>
	<th width='100' >สถานะ</th>
	<th width='100'></th>
	<th width='100'></th>
	<th></th>
	</tr>";
	while($member = $result->fetch()){
		echo "<tr>";
		
			echo "<td>";
			if($member['m_img']==""){ echo "<img src='../images/member/kis.png' width='200' height='200' >"; }
			else{ echo "<img src='../images/member/".$member['m_img']."' width='200' height='200' >";}
			echo "</td>";
			
			echo "<td>".$member['username']."</td>";
			echo "<td>".$member['m_name']."</td>";
			echo "<td>".$member['m_sex']."</td>";
			echo "<td>".$member['m_state']."</td>";
			echo "<td><a href='seeMember.php?m_id=".$member['username']."'>ดูข้อมูล</a></td>";
			echo "<td><a href='editMember.php?m_id=".$member['username']."'>แก้ไข</a></td>";
			echo "<td><a href='deleteMember.php?m_id=".$member['username']."'>ลบ</a></td>";
		
		echo "</tr>";
	}
	echo "<table></div>";
?>
</body>
</html>