<?php 

$connect = mysqli_connect("localhost","root","","health");

if ($connect){
	// echo 'connected';
}else{
	echo 'failed to connect ';
}


?>