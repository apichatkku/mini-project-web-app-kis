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
<br><br>
     	  <p align="center" style="color:#099">อัพโหลดรูปเพื่อแก้ไขรูปโปรไฟล์</p>
          
            <table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
              <td>
              <form action='checkImg.php' method='POST' enctype='multipart/form-data'>
                เลือกไฟล์รูป<br><input type='file' name='file' id='file'><br>
              	<div align="center">
                <button type='submit' style="width:100%" class="btn btn-success">อัพโหลด</button>
                &nbsp; &nbsp; &nbsp; <a href='profile.php'><button style="width:100%" type="button" class="btn btn-info">
				ไปที่หน้า Profile</button></a>
                </div>
             </form>
               </td>
              </tr>
            </table>

</body>
</html>