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
	<?php require('../main-menu.php')  ?><br><br>
    <center>

    	<table width="500px" border="0" >
    <form action="updateMember.php" method="POST">

    	  <tr>
    	    <td width="228">Username</td>
    	    <td width="16">&nbsp;</td>
    	    <td width="300"><input type="text" class="form-control" name="username" value="<?php echo $member['username']; ?>" readonly></td>
  	    </tr>
    	  <tr>
    	    <td>Password</td>
    	    <td>&nbsp;</td>
    	    <td><input type="text" class="form-control" name="password" value="<?php echo $member['password']; ?>"></td>
  	    </tr>
    	  <tr>
    	    <td>Full Name</td>
    	    <td>&nbsp;</td>
    	    <td><input type="text" class="form-control" name="name" value="<?php echo $member['m_name']; ?>" ></td>
  	    </tr>
    	  <tr>
    	    <td>Sex</td>
    	    <td>&nbsp;</td>
    	    <td><select name="sex" class="form-control">
    	      <option value="men" <?php if($member['m_sex']=='men') echo "selected"; ?>>men</option>
    	      <option value="women" <?php if($member['m_sex']=='women') echo "selected"; ?>>women</option>
  	      </select></td>
  	    </tr>
    	  <tr>
    	    <td>Address</td>
    	    <td>&nbsp;</td>
    	    <td><textarea name="address" class="form-control"><?php echo $member['address']; ?></textarea></td>
  	    </tr>
    	  <tr>
    	    <td>Mobile</td>
    	    <td>&nbsp;</td>
    	    <td><input type="text" class="form-control" name="mobile" value="<?php echo $member['mobile']; ?>" ></td>
  	    </tr>
    	  <tr>
    	    <td>email</td>
    	    <td>&nbsp;</td>
    	    <td><input type="email" class="form-control" name="email" value="<?php echo $member['email']; ?>" ></td>
  	    </tr>
    	  <tr>
    	    <td>Status</td>
    	    <td>&nbsp;</td>
    	    <td><select name="m_state" class="form-control">
    	      <option value="user" <?php if($member['m_state']=='user') echo "selected"; ?>>User</option>
    	      <option value="admin" <?php if($member['m_state']=='admin') echo "selected"; ?>>Admin</option>
  	      </select></td>
  	    </tr>
    	  <tr>
    	    <td>Score</td>
    	    <td>&nbsp;</td>
    	    <td><input type="number" class="form-control" name="m_score" value="<?php echo $member['m_score']; ?>" ></td>
  	    </tr>
    	  <tr>
    	    <td>Gold Coin</td>
    	    <td>&nbsp;</td>
    	    <td><input type="number" class="form-control" name="m_gd" value="<?php echo $member['m_score']; ?>" ></td>
  	    </tr>
    	  <tr>
    	    <td>Silver Coin</td>
    	    <td>&nbsp;</td>
    	    <td><input type="number" class="form-control" name="m_sv" value="<?php echo $member['m_score']; ?>" ></td>
  	    </tr>
  	    <tr>
    	    <td>&nbsp;</td>
    	    <td>&nbsp;</td>
    	    <td></td>
  	    </tr>
    	  <tr>
    	    <td><a href='memberList.php'><button style='width:100%;'class='btn btn-warning'>back to management</button></a></td>
    	    <td>&nbsp;</td>
    	    <td><input style="width:100%;" type="submit" class="btn btn-success" value="แก้ไข"></td>
  	    </tr>
   	 
    </form>
     </table>
</center>
</body>
</html>