<?php 
	session_start();
	if(isset($_SESSION['user'])){
		unset($_SESSION['user']);
	}
	if(isset($_SESSION['alogin'])){
		unset($_SESSION['alogin']);
	}
	header("Location: index.php");
	die(); 
 ?>