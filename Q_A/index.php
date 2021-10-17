<?php 
	session_start();
	require_once '../config/functions.php';
	require_once '../config/header.php';
	require_once '../config/db.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
// $users = $db->getRows('menu');
?>

<div id="main">
	<?php 
		if (isset($_SESSION['auth']) && $_SESSION['type'] == 'user') {
			include 'userAuth.php';
			include 'general.php';
		}elseif (isset($_SESSION['auth']) && $_SESSION['type'] == 'doctor') {
			include 'drAuth.php';
		}else{
			include 'general.php';
		}
	?>
</div>
<?php 
	
	require_once '../config/footer.php';
?>