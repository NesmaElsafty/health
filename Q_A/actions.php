<?php 
session_start();
require_once '../config/functions.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if (isset($_POST['ask'])) {
		$question = $_POST['question'];
		$user_id = $_POST['user_id'];
		$created = $_POST['created'];

		$sql = "INSERT INTO questions (question, user_id, created)
						VALUES ('".$question."', '".$user_id."', '".$created."')";
		$ask = mysqli_query($connect, $sql);
		if ($ask == true) {
			echo 'asked';
			header('location:index.php');
		}else{
			echo 'failed to ask';
		}
	}elseif (isset($_POST['answer'])) {
		$answer = $_POST['reply'];
		$question_id = $_POST['question_id'];
		$dr_id = $_POST['dr_id'];
		$created = $_POST['created'];

		$sql = "INSERT INTO answers (answer, question_id, dr_id,created)
						VALUES ('".$answer."', '".$question_id."', '".$dr_id."', '".$created."')";
		$answer = mysqli_query($connect, $sql);
		// die($answer);
		if ($answer == true) {
			echo 'answered';
			header('location:index.php');  
		}else{
			echo 'failed to answer';
		}



	}
}else{
	header('location:index.php');
}


?>