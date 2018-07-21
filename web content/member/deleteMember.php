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
		header("location:memberList.php?");
		exit(0);
	}else{
		$username = $_GET['m_id'];
		$pdo->exec("DELETE FROM member WHERE username='$username'");
		header("location:memberList.php?");
		exit(0);
	}
		
?>
