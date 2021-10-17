<?php 
require_once '../config/connect.php';

session_start();


	// $MasterPassword = 'overthinking';

	// $hashed =  password_hash($password , PASSWORD_DEFAULT);
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		echo $username;	
		$password = $_POST['password'];
		echo $password;	
		$sql = "SELECT * FROM admin WHERE username = '".$username."'";
		// die($sql);
		$get = mysqli_query($connect,$sql);
		$check = mysqli_fetch_assoc($get);

		
		 		
		}if ($password = password_verify($_POST['password'], $check['password'])||  $_POST['password'] === $check['password']){
	 		
		 		$_SESSION['unID'] = "admin";

		 		header('location:../index.php');
		 	}else{
		 		$_SESSION['loginError'] = 'password is wrong';
		 		header('location:index.php');
		 	}
		  
}else{
	// header('location:index.php');
}