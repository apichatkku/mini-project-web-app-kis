<?php
session_start();
setcookie("username","",time()-3600);
include "../connect/connect.php";

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">

	<title>ลงชื่อเข้าใช้</title>

    <link rel="stylesheet" href="../stylesheet/rsu/specimen_files/specimen_stylesheet.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
			

    <link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>

<style type="text/css">
    body{
    background-color: #e9eaed;
    }
    </style>
</head>

<body>

	<div class="main3"> <?php require("../main-menu.php") ?> </div>


<div align="center" class="main">

	<form action="checkLogin.php" method="post">
    	<?php
			unset($_SESSION['username']);
			unset($_SESSION['name']);
		 	if(isset($_GET['error'])){
				echo "<p style='color:red'>ผิดพลาด!!! ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง</p>";
			} 
		 ?>

    <fieldset style="width:300px"  align="left">
      <p class="head">LOGIN</p>
      <table border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td width="30%">username:</td>
    <td><input type="text" name="username" placeholder="username" class="form-control" minlength='1' maxlength='20'
       autofocus required pattern='[\w]+'
       title='ใส่ตัวอักษรภาษาอังกฤษหรือตัวเลข และไม่มีตัวเลขนำหน้า (1-20 ตัวอักษร)' autocomplete='off' onblur='checkUsername()'></td>
    </tr>
  <tr>
    <td width="30%">password:</td>
    <td><input type="password" name="password" placeholder="password" class="form-control" class='form-control'minlength='1' maxlength='20' placeholder='Password' pattern='[\w]+' title='ห้ามใส่ช่องว่า (1-20 ตัวอักษร)' required ></td>
    </tr>
      </table>
      </fieldset>
   <table width="300px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
        <td></td>
		    <td align="right"><input type="checkbox" name="remember"><font size='-6'>จดจำการเข้าสู่ระบบนี้</font>
            <input style="width:100px;" type="submit" class="btn btn-success" value="login"></td>
		  </tr>
</table>

    </form>
</div>
</body>
</html>