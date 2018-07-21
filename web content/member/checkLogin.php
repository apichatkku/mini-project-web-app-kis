<?php
session_start();
include "../connect/connect.php";

//เช็คว่าเข้าหน้านี้โดยผ่านการ login อ๊ะป่าว
if(!isset($_POST["username"])){
	header("location:login.php");
	exit(0);
}

if(isset($_POST["username"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$result = $pdo->query("SELECT * FROM member WHERE username  = '$username'");
	$member = $result->fetch();
	
	if($member['password']!=$password){
		header("location:login.php?error=1");
		exit(0);
	}
	
	$_SESSION['username']=$username;
	$_SESSION['name']=$member['m_name'];
	if (isset($_POST["remember"])) {
		setcookie("username", $username, time()+60*60*24*30);
	}
	header("location:profile.php");
	exit(0);
	
}

?>