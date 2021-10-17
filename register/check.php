<?php
session_start();

include '../config/functions.php';



if (isset($_POST['signin'])) {
	$email = $_POST['email'];
	$password = $_POST['password']; //password 

	$hashUser = CheckPass('users', 'email' ,$email);
	$hashDr = CheckPass('doctors', 'dr_email' ,$email);


	if (CheckEmail('users', 'email' ,$email) != '' && password_verify($password, $hashUser)) {
		echo '1something';
		$getData = getData('users','email',$email);
		$_SESSION['auth'] = $email;
		$_SESSION['type'] = 'user';
		$_SESSION['name'] = $userData['username'];

		header('location:../index.php');


	}elseif(CheckEmail('doctors', 'dr_email' ,$email) != '' && password_verify($password, $hashDr)) {
		// echo 'otherthing';
		$getData = getData('doctors', 'dr_email',$email);

		$_SESSION['auth'] = $email;
		$_SESSION['type'] = 'doctor';
		$_SESSION['name'] = $userData['dr_name'];

		header('location:../index.php');
	}else{
		header('signin.php');
	}
	
}


?>