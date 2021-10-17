<?php 
	session_start();
	require_once '../config/functions.php';
	require_once '../config/header.php';
	require_once '../config/db.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
$users = $db->getRows('doctors');
?>

<div id="main">
<h3>Doctors</h3>
<?php if(!empty($users)){ $count = 0; foreach($users as $row){ $count++; ?>
	<p>
	<strong>Name: </strong><?php echo $row['dr_name']; ?><br>
	<strong>Phone: </strong><?php echo $row['dr_phone']; ?><br>
	<strong>Address: </strong><?php echo $row['dr_address']; ?><br>
	<strong>Email: </strong><?php echo $row['dr_email']; ?><br>
	</p>
<?php } }else{ ?>
			<h4>No Doctors(s) found...</h4>
<?php } ?>
</div>
<?php 
	
	require_once '../config/footer.php';
?>