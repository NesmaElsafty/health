<?php
$connect = mysqli_connect("localhost","root","","health");
function connect(){
	$connect = mysqli_connect("localhost","root","","health");
	if (mysqli_connect_errno()) {
	  return "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}

	return $connect;
}

function CheckEmail($table,$cond ,$email){
	$connect = connect();

	$sql = "SELECT * FROM $table WHERE $cond = '".$email."'";
	// die($sql);
	$getEmail = mysqli_query($connect, $sql);
	return mysqli_num_rows($getEmail);
	
	}
function CheckPass($table, $cond ,$email){
	$connect = connect();

	$sql = "SELECT password FROM $table WHERE $cond = '".$email."'";
	// die($sql);
	$result = mysqli_query($connect, $sql);
	$get_row = mysqli_fetch_assoc($result);
	return $get_row['password'];
}

function getData($table,$cond,$email){
	$connect = connect();

	$sql = "SELECT * FROM $table WHERE $cond = '".$email."'";
	// die($sql);
	$result = mysqli_query($connect, $sql);
	$get_row = mysqli_fetch_assoc($result);
	return $get_row;
}

function getWeb($table){
	$connect = connect();

	$sql = "SELECT * FROM $table";
	// die($sql);
	$result = mysqli_query($connect, $sql);
	$get_row = mysqli_fetch_assoc($result);
	return $get_row;
}

?>