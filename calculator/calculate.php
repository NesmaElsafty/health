<?php 
session_start();
require_once '../config/functions.php';
$connect = mysqli_connect("localhost","root","","health");


// error_reporting(0);

if (isset($_SERVER['REQUEST_METHOD'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {



		$gender = $_POST['gender'];
		$activity_level = $_POST['activity_level'];
		$age = $_POST['age'];
		$hight = $_POST['hight'];
		$weight = $_POST['weight'];
// echo $gender. $activity_level. $age. $hight. $weight;

		$bmr = '';
		$result = '';

		if ($gender == 'male') {
			$bmr .= 13.75 * $weight;
			$bmr += 5 * $hight;
			$bmr -= 6.76 * $age;
			$bmr += 66;

	// echo 'MAle BMR = ' . $bmr. '<br>';

		}elseif ($gender == 'female') {
			$bmr .= 9.56 * $weight;
			$bmr += 1.85 * $hight;
			$bmr -= 4.68 * $age;
			$bmr += 655;

	// echo 'Female BMR = ' . $bmr. '<br>';
		}else{
			echo 'No Gender Selected';
		}


		switch ($activity_level) {
			case "1":
			$result = $bmr * 1.2;
			break;
			case "2":
			$result = $bmr * 1.375;
			break;
			case "3":
			$result = $bmr * 1.55;
			break;
			case "4":
			$result = $bmr * 1.725;
			break;
			case "5":
			$result = $bmr * 1.9;
			break;
			default:
			echo "No Level Selected";
		}

// echo 'Result: ' . $result;

		if ($gender == '' || $activity_level == '' || $age == '' || $hight == '' || $weight == '') {
		$_SESSION['error'] = 'Please Fill The Empty Values';
			// echo 'Please Fill The Empty Values';
		header('location:index.php');
		}else{
			if(isset($_SESSION['auth'])){
			$sql = "UPDATE users
						SET cal_result = '".$result."'
						WHERE email = '".$_SESSION['auth']."'";
			$query = mysqli_query($connect, $sql);
			if ($query == TRUE) {
				// echo 'result inserted';
				$_SESSION['result'] = 'your result is: ' . $result;
				header("location:index.php");
			}else{
				echo "failed to insert result";
				
			}

			}else{
				$_SESSION['error'] = 'you have to sign in first to get the result';
				// echo $_SESSION['error'];
				header("location:index.php");
			}

	}
}
}else{
	header("location:../index.php");
}
?>