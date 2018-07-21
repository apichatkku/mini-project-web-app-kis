<?php  
session_start();//start session

include "../connect/connect.php";
	
	
	if(isset($_POST['username'])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$m_name = $_POST["m_name"];
		$m_sex = $_POST["m_sex"];
		$address = $_POST["address"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		$result = $pdo->query("SELECT * FROM member WHERE username  = '$username'");
		$member = $result->fetch();
		if($username==$member['username']){
			$_SESSION['errorRegis']=1;
			header("location:formRegister.php");
			exit(0);
		}else if($username!=$member['username']){
			unset($_SESSION['errorRegis']);
			$_SESSION['m_name']=$m_name;
			$_SESSION['regisSuccess']=1;
			$pdo->exec("INSERT INTO member VALUES ('$username','$password',
			'$m_name','$m_sex','$address','$mobile','$email','user','',0,0,0)");
			header("location:regisSuccess.php");
			exit(0);
		}
	}
?>

<html>
<head>
	<meta charset="utf-8">

				<link rel="stylesheet" href="../stylesheet/rsu/specimen_files/specimen_stylesheet.css" type="text/css" charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="../stylesheet/fonts.css"/>
	

    <link rel="stylesheet" type="text/css" href="../stylesheet/main-menu.css"/>
    <link rel="stylesheet" type="text/css" href="../stylesheet/formAll.css"/>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>

    <style type="text/css">
    	body{
			background-color: #e9eaed;
		}
		
		.thinking {
			background: white url("img/checking.gif") no-repeat;
			background-position: 150px 1px;
		}
		.approved {
			background: white url("img/true.gif") no-repeat;
			background-position: 150px 1px;
		}
		.denied {
			background: #FF8282 url("img/false.gif") no-repeat;
			background-position: 150px 1px;
		}
    </style>
	<script>
	var xmlHttp;
	function checkUsername() {
		document.getElementById("username").className = "thinking";
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange= showUsernameStatus;
		var username = document.getElementById("username").value;
		var url = "checkName.php?username=" + username;
		xmlHttp.open("GET", url);
		xmlHttp.send();
	}
	
	function showUsernameStatus(){
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			if (xmlHttp.responseText == "okay") {
				document.getElementById("username").className = "approved";
			}
			else {
				document.getElementById("username").className = "denied";
				document.getElementById("username").focus();
				document.getElementById("username").select();
			}
		}
	}
	</script>
</head>
    
<body>

<div class="main3">
  <?php require("../main-menu.php") ?>
</div>

	<div align='center' class='main2'>
	<?php
		
		if(isset($_SESSION['errorRegis'])){
			echo "<p style='color:red;'>ชื่อผู้ใช้(Username)ซ้ำ กรุณาตั้งชื่อผู้ใช้ใหม่ค่ะ</p>";
		}
		echo "
		
	<form  action='formRegister.php' method='post' >
		  <fieldset style='width:500px'  align='left'>
      <p class='head'>สมัครสมาชิก</p>
      <table border='0' cellspacing='0' cellpadding='0' class='table'>
  <tr>
    <td width='30%' >Username</td>
    <td width='5%'>:</td>
			<td ><input type='text' id='username' name='username' placeholder='username' class='form-control' minlength='4' maxlength='20'
			 autofocus required pattern='[\w]+'
			 title='ใส่ตัวอักษรภาษาอังกฤษหรือตัวเลข และไม่มีตัวเลขนำหน้า (4-20 ตัวอักษร)' autocomplete='off' onkeyup='checkUsername()' ></td>
			</tr>
  <tr>
    <td width='30%'>Password</td>
    <td width='5%'>:</td>
   		<td><input type='password' name='password' placeholder='password' class='form-control'minlength='4' maxlength='20' placeholder='Password' pattern='[\w]+' title='ห้ามใส่ช่องว่า (4-20 ตัวอักษร)' required ></td>
   	</tr>
   	<tr>
    <td width='30%'>Confirm Password</td>
    <td width='5%'>:</td>
   		<td><input type='password' name='password2' placeholder='Confirm Password' class='form-control' minlength='4' maxlength='20' placeholder='Password' pattern='[\w]+' title='ห้ามใส่ช่องว่า (4-20 ตัวอักษร)' required ></td>
   	</tr>
	<tr>
    <td width='30%'>ชื่อ-สกุล</td>
    <td width='5%'>:</td>
   		<td><input type='text' name='m_name' placeholder='ชื่อ-สกุล' class='form-control' pattern='[^*^$^+^-^/^=^&^|^\d]+' title='ห้ามใส่ตัวเลขหรืออักษรพิเศษ' required></td>
   	</tr>
	<tr>
    <td width='30%'>เพศ</td>
    <td width='5%'>:</td>
    	<td><select name='m_sex' class='form-control'>
            	<option value='man'>ชาย</option>
            	<option value='women'>หญิง</option>
				</select></td>
   	</tr>
	<tr>
    <td width='30%'>ที่อยู่</td>
    <td width='5%'>:</td>
    	<td><textarea name='address' rows='3' cols='40' class='form-control' placeholder='ที่อยู่เพิ่มเติม'></textarea></td>
   	</tr>
	<tr>
    <td width='30%'>เบอร์โทรศัพท์</td>
    <td width='5%'>:</td>
    	<td><input type='text' name='mobile' class='form-control' placeholder='0123456789' pattern='[0-9]{10}'
		title='เฉพาะตัวเลข10ตัว 0800000000' required></td>
   	</tr>
		<tr>
    <td width='30%'>E-mail</td>
    <td width='5%'>:</td>
    	<td><input type='email' name='email' class='form-control' placeholder='xxxxx@hotmail.com' title='xxxxxx@hotmail.com' required></td>
   	</tr>
      </table>
      </fieldset>
		  <table width='500px' border='0' cellspacing='0' cellpadding='0'>
		  <tr>
        	<td><input style='width:100px;' type='reset' class='btn btn-reset' value='reset'></td>
		    <td align='right'><input style='width:100%;' type='submit' class='btn btn-success' value='register'></td>
		  </tr>
</table>
		</form>

</div>
		";
		unset($_SESSION['errorRegis']);
	?>
</body>
</html>
