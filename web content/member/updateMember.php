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
	
	if(isset($_POST['username'])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$m_name = $_POST["name"];
		$m_sex = $_POST["sex"];
		$address = $_POST["address"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		$m_state = $_POST["m_state"];
		$m_score = $_POST["m_score"];
		$m_gd = $_POST["m_gd"];
		$m_sv = $_POST["m_sv"];
		
		$pdo->exec("UPDATE member SET password='$password' , m_name='$m_name' , m_sex = '$m_sex' , address='$address' ,
		mobile='$mobile' , email='$email' , m_state='$m_state' , m_score='$m_score' , m_gd='$m_gd' , m_sv='$m_sv'
		WHERE username = '$username' ");
		
		header("location:seeMember.php?m_id=$username");
		exit(0);
	}
		
?>
