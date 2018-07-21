<?php
include "../connect/connect.php";

$username=$_GET['username'];
$result = $pdo->query("SELECT * FROM member WHERE username = '$username'");
$row = $result->fetch();
sleep(1);
if($row['username']==''){
	echo "okay";
}else {
	echo "denied";
}

?>