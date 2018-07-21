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
	<title>แบบฟอร์มเพิ่มสินค้า</title>


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
<?php require('../main-menu.php')  ?><br><br>
<center stylesheet="magin-top:400px;">

	<form action="addProduct.php" method="post">
	  <table width="600" border="0">
        <tr>
            <td width="250">รหัสสินค้า</td>
            <td width="10">:</td>
            <td width="257"><input class="form-control" type="text" name="p_id"></td>
          </tr>
          <tr>
            <td>ประเภทสินค้า</td>
            <td>:</td>
            <td><select name="p_type" class="form-control">
              <option value="hat">หมวก</option>
              <option value="shirt">เสื้อ</option>
              <option value="bags">กระเป๋า</option>
              <option value="watch">นาฬิกา</option>
              <option value="pants">กางเกง</option>
              <option value="shoes">รองเท้า</option>
            </select></td>
          </tr>
          <tr>
            <td>ยี่ห้อ</td>
            <td>:</td>
            <td><select name="p_brand" class="form-control">
              <option value="24.01">24:01</option>
              <option value="alcott">Alcott</option>
              <option value="america eagle">America Eagle</option>
              <option value="bag wizard">Bag wizard</option>
              <option value="bagazilla">Bagazilla</option>
              <option value="caramel">Caramel</option>
              <option value="casio">Casio</option>
              <option value="cheap monday">Cheap Monday</option>
              <option value="cherich by donna step">Cherich By Donna Step</option>
              <option value="classy">Classy</option>
              <option value="converse">Converse</option>
              <option value="cps charps">CPS charps</option>
              <option value="dziner">Dziner</option>
              <option value="fila">Fila</option>
              <option value="flesh imp">Flesh imp</option>
              <option value="guess">Guess</option>
              <option value="hara">Hara</option>
              <option value="hater">Hater</option>
              <option value="koumi koumi">Koumi Koumi</option>
              <option value="levis">Levis</option>
              <option value="morning">Morning</option>
              <option value="mango">Mango</option>
              <option value="new balance">New Balance</option>
              <option value="nike">Nike</option>
              <option value="northstar">North Star</option>
              <option value="portland">Portland</option>
              <option value="q&q by citizen">Q&Q By Citizen</option>
              <option value="rip curl">Rip Curl</option>
              <option value="rubi">Rubi</option>
              <option value="solus">Solus</option>
              <option value="something borrowed">Something Borrowed</option>
              <option value="sweet camel">Sweet camel</option>
              <option value="timepiece society">Timepiece Society</option>
              <option value="the collection by jjm">The Collection by JJM</option>
              <option value="the mad hatter">The mad hatter</option>
              <option value="urban research">Urban Research</option>
              <option value="vans">Vans</option>
            </select></td>
          </tr>
          <tr>
            <td>คำอธิบาย</td>
            <td>:</td>
            <td><textarea width="70%" class="form-control" name="p_title" rows="3" cols="40" ></textarea></td>
          </tr>
          <tr>
            <td>ราคา</td>
            <td>:</td>
            <td><input class="form-control" type="number" name="p_price"></td>
          </tr>
          <tr>
            <td>สินค้าสำหรับ</td>
            <td>:</td>
            <td><select class="form-control" name="p_sex">
              <option value="men">ชาย</option>
              <option value="women">หญิง</option>
              <option value="all">ทุกเพศ</option>
            </select></td>
          </tr>
          <tr>
            <td>จำนวนรูปภาพ</td>
            <td>:</td>
            <td><input class="form-control" type="number" name="p_numimage"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" class="btn btn-success" value="เพิ่มข้อมูล"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
	</form>
    
    </center>
    

</div>
</body>
</html>